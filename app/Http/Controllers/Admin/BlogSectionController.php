<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class BlogSectionController extends Controller
{
    public function index()
    {
        $sections = BlogSection::orderBy('sort_order')->get();
        return view('admin.blog-sections.index', compact('sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => ['required', 'string', 'max:255', 'unique:blog_sections,slug'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'url', 'max:2048'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $section = BlogSection::create([
            'slug' => $data['slug'],
            'subtitle' => $data['subtitle'] ?? null,
            'title' => $data['title'],
            'button_text' => $data['button_text'] ?? null,
            'button_url' => $data['button_url'] ?? null,
            'is_active' => (bool) $data['is_active'],
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        Cache::forget('homepage:blog-section');

        return back()->with('success', 'Section berhasil dibuat.');
    }

    public function update(Request $request, BlogSection $section)
    {
        $data = $request->validate([
            'slug' => ['required', 'string', 'max:255', Rule::unique('blog_sections', 'slug')->ignore($section->id)],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'url', 'max:2048'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $section->slug = $data['slug'];
        $section->subtitle = $data['subtitle'] ?? null;
        $section->title = $data['title'];
        $section->button_text = $data['button_text'] ?? null;
        $section->button_url = $data['button_url'] ?? null;
        $section->is_active = (bool) $data['is_active'];
        $section->sort_order = $data['sort_order'] ?? 0;
        $section->save();

        Cache::forget('homepage:blog-section');

        return back()->with('success', 'Section berhasil diperbarui.');
    }

    public function destroy(BlogSection $section)
    {
        $section->delete();
        Cache::forget('homepage:blog-section');
        return back()->with('success', 'Section berhasil dihapus.');
    }
}
