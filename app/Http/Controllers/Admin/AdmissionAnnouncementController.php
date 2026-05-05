<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdmissionAnnouncementController extends Controller
{
    public function index()
    {
        $announcements = AdmissionAnnouncement::query()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.admission-announcements.index', compact('announcements'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:120'],
            'button_url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $stored = $request->file('image')->store('announcements/popup', 'public');
            $imagePath = 'storage/' . $stored;
        } elseif (!empty($data['image_url'])) {
            $imagePath = $data['image_url'];
        }

        AdmissionAnnouncement::create([
            'title' => $data['title'],
            'subtitle' => $data['subtitle'] ?? null,
            'image_path' => $imagePath,
            'image_alt' => $data['image_alt'] ?? null,
            'button_text' => $data['button_text'] ?? null,
            'button_url' => $data['button_url'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => (bool) $data['is_active'],
        ]);

        $this->forgetCache();

        return back()->with('success', 'Popup pengumuman berhasil ditambahkan.');
    }

    public function update(Request $request, AdmissionAnnouncement $announcement)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:120'],
            'button_url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        if (!empty($data['remove_image'])) {
            $this->deletePublicPath($announcement->image_path);
            $announcement->image_path = null;
        }

        if ($request->hasFile('image')) {
            $this->deletePublicPath($announcement->image_path);
            $stored = $request->file('image')->store('announcements/popup', 'public');
            $announcement->image_path = 'storage/' . $stored;
        } elseif (!empty($data['image_url'])) {
            $this->deletePublicPath($announcement->image_path);
            $announcement->image_path = $data['image_url'];
        }

        $announcement->title = $data['title'];
        $announcement->subtitle = $data['subtitle'] ?? null;
        $announcement->image_alt = $data['image_alt'] ?? null;
        $announcement->button_text = $data['button_text'] ?? null;
        $announcement->button_url = $data['button_url'] ?? null;
        $announcement->sort_order = $data['sort_order'] ?? 0;
        $announcement->is_active = (bool) $data['is_active'];
        $announcement->save();

        $this->forgetCache();

        return back()->with('success', 'Popup pengumuman berhasil diperbarui.');
    }

    public function destroy(AdmissionAnnouncement $announcement)
    {
        $this->deletePublicPath($announcement->image_path);
        $announcement->delete();
        $this->forgetCache();

        return back()->with('success', 'Popup pengumuman berhasil dihapus.');
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
        Cache::forget('homepage:active-admission-announcement');
    }
}

