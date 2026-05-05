<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoGalleryItem;
use App\Models\VideoGallerySection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class VideoGalleryItemController extends Controller
{
    public function index()
    {
        $items = VideoGalleryItem::with('section')
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->get();

        $sections = VideoGallerySection::orderBy('sort_order')->get();

        return view('admin.video-gallery-items.index', compact('items', 'sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'video_gallery_section_id' => ['required', Rule::exists('video_gallery_sections', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'video_url' => ['required', 'url', 'max:2048'],
            'play_icon_class' => ['nullable', 'string', 'max:255'],
            'animation_delay_ms' => ['nullable', 'integer', 'min:0', 'max:60000'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $item = VideoGalleryItem::create([
            'video_gallery_section_id' => $data['video_gallery_section_id'],
            'title' => $data['title'],
            'video_url' => $data['video_url'],
            'play_icon_class' => $data['play_icon_class'] ?: 'flaticon-play-button-1',
            'animation_delay_ms' => $data['animation_delay_ms'] ?? 300,
            'sort_order' => $data['sort_order'],
            'is_active' => (bool) $data['is_active'],
        ]);

        $this->forgetVideoCache();

        return back()->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(VideoGalleryItem $item)
    {
        $sections = VideoGallerySection::orderBy('sort_order')->get();
        return view('admin.video-gallery-items.edit', compact('item', 'sections'));
    }

    public function update(Request $request, VideoGalleryItem $item)
    {
        $data = $request->validate([
            'video_gallery_section_id' => ['required', Rule::exists('video_gallery_sections', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'video_url' => ['required', 'url', 'max:2048'],
            'play_icon_class' => ['nullable', 'string', 'max:255'],
            'animation_delay_ms' => ['nullable', 'integer', 'min:0', 'max:60000'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $item->video_gallery_section_id = $data['video_gallery_section_id'];
        $item->title = $data['title'];
        $item->video_url = $data['video_url'];
        $item->play_icon_class = $data['play_icon_class'] ?: 'flaticon-play-button-1';
        $item->animation_delay_ms = $data['animation_delay_ms'] ?? 300;
        $item->sort_order = $data['sort_order'];
        $item->is_active = (bool) $data['is_active'];
        $item->save();

        // bust cache untuk section lama & baru
        $this->forgetVideoCache();

        return redirect()->route('admin.video-items.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(VideoGalleryItem $item)
    {
        $item->delete();

        $this->forgetVideoCache();

        return back()->with('success', 'Video berhasil dihapus.');
    }

    private function forgetVideoCache(): void
    {
        Cache::forget('homepage:video-section');
    }
}
