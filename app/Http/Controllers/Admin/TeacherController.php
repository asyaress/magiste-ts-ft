<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('section')
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->get();

        $sections = TeacherSection::orderBy('sort_order')->get();

        return view('admin.teachers.index', compact('teachers', 'sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_section_id' => ['required', Rule::exists('teacher_sections', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],

            'photo' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'photo_alt' => ['nullable', 'string', 'max:255'],

            'profile_url' => ['nullable', 'url', 'max:2048'],
            'linkedin_url' => ['nullable', 'url', 'max:2048'],
            'scholar_url' => ['nullable', 'url', 'max:2048'],
            'website_url' => ['nullable', 'url', 'max:2048'],

            'col_classes' => ['nullable', 'string', 'max:255'],
            'wow_animation_class' => ['nullable', 'string', 'max:255'],
            'animation_delay_ms' => ['nullable', 'integer', 'min:0', 'max:60000'],
            'animation_duration_ms' => ['nullable', 'integer', 'min:0', 'max:60000'],

            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $data['slug'] = filled($data['slug'] ?? null) ? $data['slug'] : Str::slug($data['name']);
        $data['col_classes'] = filled($data['col_classes'] ?? null) ? $data['col_classes'] : 'col-xl-3 col-lg-6 col-md-6';
        $data['wow_animation_class'] = filled($data['wow_animation_class'] ?? null) ? $data['wow_animation_class'] : 'wow fadeInUp';
        $data['animation_delay_ms'] = $data['animation_delay_ms'] ?? 100;
        $data['animation_duration_ms'] = $data['animation_duration_ms'] ?? 1500;

        // upload foto (opsional)
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('teachers', 'public');
            $data['photo_path'] = 'storage/' . $path;
        }

        $teacher = Teacher::create([
            'teacher_section_id' => $data['teacher_section_id'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'tagline' => $data['tagline'] ?? null,
            'photo_path' => $data['photo_path'] ?? null,
            'photo_alt' => $data['photo_alt'] ?? null,
            'profile_url' => $data['profile_url'] ?? null,
            'linkedin_url' => $data['linkedin_url'] ?? null,
            'scholar_url' => $data['scholar_url'] ?? null,
            'website_url' => $data['website_url'] ?? null,
            'col_classes' => $data['col_classes'],
            'wow_animation_class' => $data['wow_animation_class'],
            'animation_delay_ms' => $data['animation_delay_ms'],
            'animation_duration_ms' => $data['animation_duration_ms'],
            'sort_order' => $data['sort_order'],
            'is_active' => (bool) $data['is_active'],
        ]);

        $this->forgetTeacherCache();

        return back()->with('success', 'Pengajar berhasil ditambahkan.');
    }

    public function edit(Teacher $teacher)
    {
        $sections = TeacherSection::orderBy('sort_order')->get();
        return view('admin.teachers.edit', compact('teacher', 'sections'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'teacher_section_id' => ['required', Rule::exists('teacher_sections', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],

            'photo' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'remove_photo' => ['nullable', 'boolean'],
            'photo_alt' => ['nullable', 'string', 'max:255'],

            'profile_url' => ['nullable', 'url', 'max:2048'],
            'linkedin_url' => ['nullable', 'url', 'max:2048'],
            'scholar_url' => ['nullable', 'url', 'max:2048'],
            'website_url' => ['nullable', 'url', 'max:2048'],

            'col_classes' => ['nullable', 'string', 'max:255'],
            'wow_animation_class' => ['nullable', 'string', 'max:255'],
            'animation_delay_ms' => ['nullable', 'integer', 'min:0', 'max:60000'],
            'animation_duration_ms' => ['nullable', 'integer', 'min:0', 'max:60000'],

            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $teacher->teacher_section_id = $data['teacher_section_id'];
        $teacher->name = $data['name'];
        $teacher->slug = filled($data['slug'] ?? null) ? $data['slug'] : Str::slug($data['name']);
        $teacher->tagline = $data['tagline'] ?? null;

        // foto
        if (!empty($data['remove_photo'])) {
            $this->deletePublicPath($teacher->photo_path);
            $teacher->photo_path = null;
        }
        if ($request->hasFile('photo')) {
            $this->deletePublicPath($teacher->photo_path);
            $path = $request->file('photo')->store('teachers', 'public');
            $teacher->photo_path = 'storage/' . $path;
        }

        $teacher->photo_alt = $data['photo_alt'] ?? null;
        $teacher->profile_url = $data['profile_url'] ?? null;
        $teacher->linkedin_url = $data['linkedin_url'] ?? null;
        $teacher->scholar_url = $data['scholar_url'] ?? null;
        $teacher->website_url = $data['website_url'] ?? null;

        $teacher->col_classes = filled($data['col_classes'] ?? null) ? $data['col_classes'] : 'col-xl-3 col-lg-6 col-md-6';
        $teacher->wow_animation_class = filled($data['wow_animation_class'] ?? null) ? $data['wow_animation_class'] : 'wow fadeInUp';
        $teacher->animation_delay_ms = $data['animation_delay_ms'] ?? 100;
        $teacher->animation_duration_ms = $data['animation_duration_ms'] ?? 1500;

        $teacher->sort_order = $data['sort_order'];
        $teacher->is_active = (bool) $data['is_active'];
        $teacher->save();

        // bust cache (lama & baru)
        $this->forgetTeacherCache();

        return redirect()->route('admin.teachers.index')->with('success', 'Pengajar berhasil diperbarui.');
    }

    public function destroy(Teacher $teacher)
    {
        $this->deletePublicPath($teacher->photo_path);
        $teacher->delete();

        $this->forgetTeacherCache();

        return back()->with('success', 'Pengajar berhasil dihapus.');
    }

    private function deletePublicPath(?string $publicPath): void
    {
        if (!$publicPath)
            return;
        if (Str::startsWith($publicPath, 'storage/')) {
            $rel = Str::after($publicPath, 'storage/');
            Storage::disk('public')->delete($rel);
        }
    }

    private function forgetTeacherCache(): void
    {
        Cache::forget('homepage:teacher-section');
        Cache::forget('homepage:team-page-section');
    }
}
