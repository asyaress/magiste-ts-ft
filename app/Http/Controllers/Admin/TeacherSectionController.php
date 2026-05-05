<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class TeacherSectionController extends Controller
{
    public function index()
    {
        $sections = TeacherSection::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.teacher-sections.index', compact('sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => ['required', 'string', 'max:255', 'unique:teacher_sections,slug'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        TeacherSection::create([
            'slug' => $data['slug'],
            'subtitle' => $data['subtitle'] ?? null,
            'title' => $data['title'],
            'is_active' => (bool) $data['is_active'],
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        $this->forgetCaches();

        return back()->with('success', 'Section pengajar berhasil dibuat.');
    }

    public function update(Request $request, TeacherSection $section)
    {
        $data = $request->validate([
            'slug' => ['required', 'string', 'max:255', Rule::unique('teacher_sections', 'slug')->ignore($section->id)],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $section->slug = $data['slug'];
        $section->subtitle = $data['subtitle'] ?? null;
        $section->title = $data['title'];
        $section->is_active = (bool) $data['is_active'];
        $section->sort_order = $data['sort_order'] ?? 0;
        $section->save();

        $this->forgetCaches();

        return back()->with('success', 'Section pengajar berhasil diperbarui.');
    }

    public function destroy(TeacherSection $section)
    {
        $section->delete();
        $this->forgetCaches();

        return back()->with('success', 'Section pengajar berhasil dihapus.');
    }

    private function forgetCaches(): void
    {
        Cache::forget('homepage:teacher-section');
        Cache::forget('homepage:team-page-section');
    }
}
