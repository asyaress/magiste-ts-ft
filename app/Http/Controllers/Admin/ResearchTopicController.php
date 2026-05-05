<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResearchSection;
use App\Models\ResearchTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ResearchTopicController extends Controller
{
    public function index()
    {
        // ambil semua topik (bisa difilter per section kalau mau)
        $topics = ResearchTopic::with('section')->orderBy('sort_order')->orderBy('id', 'desc')->get();
        $sections = ResearchSection::orderBy('sort_order')->get();

        return view('admin.research-topics.index', compact('topics', 'sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'research_section_id' => ['required', Rule::exists('research_sections', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon_class' => ['nullable', 'string', 'max:255'],
            'bg_color_class' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'gallery_image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'animation_delay_ms' => ['nullable', 'integer', 'min:0', 'max:60000'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        // slug otomatis kalau kosong
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

        // simpan file (jika ada)
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('research/topics', 'public');
            // simpan path publik
            $data['image_path'] = 'storage/' . $data['image_path'];
        }

        if ($request->hasFile('gallery_image')) {
            $data['gallery_image_path'] = $request->file('gallery_image')->store('research/topics', 'public');
            $data['gallery_image_path'] = 'storage/' . $data['gallery_image_path'];
        }

        $topic = ResearchTopic::create([
            'research_section_id' => $data['research_section_id'],
            'title' => $data['title'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null,
            'icon_class' => $data['icon_class'] ?? null,
            'bg_color_class' => $data['bg_color_class'] ?? null,
            'image_path' => $data['image_path'] ?? null,
            'image_alt' => $data['image_alt'] ?? null,
            'gallery_image_path' => $data['gallery_image_path'] ?? null,
            'animation_delay_ms' => $data['animation_delay_ms'] ?? 0,
            'is_active' => (bool) $data['is_active'],
            'sort_order' => $data['sort_order'],
        ]);

        // bust cache FE untuk section terkait
        $this->forgetSectionCache();

        return back()->with('success', 'Topik riset berhasil ditambahkan.');
    }

    public function edit(ResearchTopic $topic)
    {
        $sections = ResearchSection::orderBy('sort_order')->get();
        return view('admin.research-topics.edit', compact('topic', 'sections'));
    }

    public function update(Request $request, ResearchTopic $topic)
    {
        $data = $request->validate([
            'research_section_id' => ['required', Rule::exists('research_sections', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon_class' => ['nullable', 'string', 'max:255'],
            'bg_color_class' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'remove_image' => ['nullable', 'boolean'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'gallery_image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'remove_gallery_image' => ['nullable', 'boolean'],
            'animation_delay_ms' => ['nullable', 'integer', 'min:0', 'max:60000'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        $topic->title = $data['title'];
        $topic->slug = $data['slug'] ?: Str::slug($data['title']);
        $topic->research_section_id = $data['research_section_id'];
        $topic->description = $data['description'] ?? null;
        $topic->icon_class = $data['icon_class'] ?? null;
        $topic->bg_color_class = $data['bg_color_class'] ?? null;
        $topic->image_alt = $data['image_alt'] ?? null;
        $topic->animation_delay_ms = $data['animation_delay_ms'] ?? 0;
        $topic->is_active = (bool) $data['is_active'];
        $topic->sort_order = $data['sort_order'];

        // gambar utama
        if (!empty($data['remove_image'])) {
            $this->deletePublicPath($topic->image_path);
            $topic->image_path = null;
        }
        if ($request->hasFile('image')) {
            $this->deletePublicPath($topic->image_path);
            $path = $request->file('image')->store('research/topics', 'public');
            $topic->image_path = 'storage/' . $path;
        }

        // gallery image
        if (!empty($data['remove_gallery_image'])) {
            $this->deletePublicPath($topic->gallery_image_path);
            $topic->gallery_image_path = null;
        }
        if ($request->hasFile('gallery_image')) {
            $this->deletePublicPath($topic->gallery_image_path);
            $path = $request->file('gallery_image')->store('research/topics', 'public');
            $topic->gallery_image_path = 'storage/' . $path;
        }

        $topic->save();

        // bust cache untuk section lama & baru
        $this->forgetSectionCache();

        return redirect()->route('admin.research-topics.index')->with('success', 'Topik riset berhasil diperbarui.');
    }

    public function destroy(ResearchTopic $topic)
    {
        $this->deletePublicPath($topic->image_path);
        $this->deletePublicPath($topic->gallery_image_path);
        $topic->delete();

        $this->forgetSectionCache();

        return back()->with('success', 'Topik riset berhasil dihapus.');
    }

    private function deletePublicPath(?string $publicPath): void
    {
        if (!$publicPath)
            return;
        // public/storage/xxx => storage disk 'public'
        if (Str::startsWith($publicPath, 'storage/')) {
            $relative = Str::after($publicPath, 'storage/');
            Storage::disk('public')->delete($relative);
        }
    }

    private function forgetSectionCache(): void
    {
        Cache::forget('homepage:research-section');
    }
}
