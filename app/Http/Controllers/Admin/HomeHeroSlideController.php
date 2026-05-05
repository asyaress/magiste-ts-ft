<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeHeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeHeroSlideController extends Controller
{
    public function index()
    {
        $slides = HomeHeroSlide::query()->orderBy('sort_order')->orderBy('id')->get();
        return view('admin.home-hero-slides.index', compact('slides'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kicker' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'background_image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'background_image_url' => ['nullable', 'url', 'max:2048'],
            'primary_button_text' => ['nullable', 'string', 'max:255'],
            'primary_button_url' => ['nullable', 'url', 'max:2048'],
            'secondary_button_text' => ['nullable', 'string', 'max:255'],
            'secondary_button_url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $imagePath = null;
        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->store('home/hero', 'public');
            $imagePath = 'storage/' . $path;
        } elseif (!empty($data['background_image_url'])) {
            $imagePath = $data['background_image_url'];
        }

        HomeHeroSlide::create([
            'kicker' => $data['kicker'] ?? null,
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'background_image_path' => $imagePath,
            'primary_button_text' => $data['primary_button_text'] ?? null,
            'primary_button_url' => $data['primary_button_url'] ?? null,
            'secondary_button_text' => $data['secondary_button_text'] ?? null,
            'secondary_button_url' => $data['secondary_button_url'] ?? null,
            'sort_order' => $data['sort_order'],
            'is_active' => (bool) $data['is_active'],
        ]);

        $this->forgetCache();

        return back()->with('success', 'Slide hero berhasil ditambahkan.');
    }

    public function update(Request $request, HomeHeroSlide $slide)
    {
        $data = $request->validate([
            'kicker' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'background_image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'background_image_url' => ['nullable', 'url', 'max:2048'],
            'remove_background_image' => ['nullable', 'boolean'],
            'primary_button_text' => ['nullable', 'string', 'max:255'],
            'primary_button_url' => ['nullable', 'url', 'max:2048'],
            'secondary_button_text' => ['nullable', 'string', 'max:255'],
            'secondary_button_url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        if (!empty($data['remove_background_image'])) {
            $this->deletePublicPath($slide->background_image_path);
            $slide->background_image_path = null;
        }
        if ($request->hasFile('background_image')) {
            $this->deletePublicPath($slide->background_image_path);
            $path = $request->file('background_image')->store('home/hero', 'public');
            $slide->background_image_path = 'storage/' . $path;
        } elseif (!empty($data['background_image_url'])) {
            $this->deletePublicPath($slide->background_image_path);
            $slide->background_image_path = $data['background_image_url'];
        }

        $slide->kicker = $data['kicker'] ?? null;
        $slide->title = $data['title'];
        $slide->description = $data['description'] ?? null;
        $slide->primary_button_text = $data['primary_button_text'] ?? null;
        $slide->primary_button_url = $data['primary_button_url'] ?? null;
        $slide->secondary_button_text = $data['secondary_button_text'] ?? null;
        $slide->secondary_button_url = $data['secondary_button_url'] ?? null;
        $slide->sort_order = $data['sort_order'];
        $slide->is_active = (bool) $data['is_active'];
        $slide->save();

        $this->forgetCache();

        return back()->with('success', 'Slide hero berhasil diperbarui.');
    }

    public function destroy(HomeHeroSlide $slide)
    {
        $this->deletePublicPath($slide->background_image_path);
        $slide->delete();
        $this->forgetCache();

        return back()->with('success', 'Slide hero berhasil dihapus.');
    }

    private function deletePublicPath(?string $publicPath): void
    {
        if (!$publicPath) {
            return;
        }

        if (Str::startsWith($publicPath, 'storage/')) {
            Storage::disk('public')->delete(Str::after($publicPath, 'storage/'));
        }
    }

    private function forgetCache(): void
    {
        Cache::forget('homepage:hero-slides');
    }
}
