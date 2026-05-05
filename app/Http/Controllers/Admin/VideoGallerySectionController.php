<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoGallerySection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VideoGallerySectionController extends Controller
{
    public function index()
    {
        $sections = VideoGallerySection::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.video-gallery-sections.index', compact('sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => ['required', 'string', 'max:255', 'unique:video_gallery_sections,slug'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'background_image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'background_image_url' => ['nullable', 'url', 'max:2048'],
            'background_image_alt' => ['nullable', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $backgroundPath = null;
        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->store('video/sections', 'public');
            $backgroundPath = 'storage/' . $path;
        } elseif (!empty($data['background_image_url'])) {
            $backgroundPath = $data['background_image_url'];
        }

        VideoGallerySection::create([
            'slug' => $data['slug'],
            'title' => $data['title'],
            'subtitle' => $data['subtitle'] ?? null,
            'background_image_path' => $backgroundPath,
            'background_image_alt' => $data['background_image_alt'] ?? null,
            'is_active' => (bool) $data['is_active'],
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        $this->forgetHomepageCache();

        return back()->with('success', 'Section video berhasil dibuat.');
    }

    public function update(Request $request, VideoGallerySection $section)
    {
        $data = $request->validate([
            'slug' => ['required', 'string', 'max:255', Rule::unique('video_gallery_sections', 'slug')->ignore($section->id)],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'background_image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'background_image_url' => ['nullable', 'url', 'max:2048'],
            'remove_background_image' => ['nullable', 'boolean'],
            'background_image_alt' => ['nullable', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $section->slug = $data['slug'];
        $section->title = $data['title'];
        $section->subtitle = $data['subtitle'] ?? null;
        $section->background_image_alt = $data['background_image_alt'] ?? null;
        $section->is_active = (bool) $data['is_active'];
        $section->sort_order = $data['sort_order'] ?? 0;

        if (!empty($data['remove_background_image'])) {
            $this->deletePublicPath($section->background_image_path);
            $section->background_image_path = null;
        }

        if ($request->hasFile('background_image')) {
            $this->deletePublicPath($section->background_image_path);
            $path = $request->file('background_image')->store('video/sections', 'public');
            $section->background_image_path = 'storage/' . $path;
        } elseif (!empty($data['background_image_url'])) {
            $this->deletePublicPath($section->background_image_path);
            $section->background_image_path = $data['background_image_url'];
        }

        $section->save();
        $this->forgetHomepageCache();

        return back()->with('success', 'Section video berhasil diperbarui.');
    }

    public function destroy(VideoGallerySection $section)
    {
        $this->deletePublicPath($section->background_image_path);
        $section->delete();

        $this->forgetHomepageCache();

        return back()->with('success', 'Section video berhasil dihapus.');
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

    private function forgetHomepageCache(): void
    {
        Cache::forget('homepage:video-section');
    }
}
