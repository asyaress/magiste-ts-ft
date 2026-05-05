<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeMissionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeMissionItemController extends Controller
{
    public function index()
    {
        $items = HomeMissionItem::query()->orderBy('sort_order')->orderBy('id')->get();
        return view('admin.home-mission-items.index', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon_class' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'animation_class' => ['nullable', 'string', 'max:255'],
            'animation_delay_ms' => ['nullable', 'integer', 'min:0', 'max:60000'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        HomeMissionItem::create([
            'icon_class' => $data['icon_class'] ?? 'flaticon-architect',
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'animation_class' => $data['animation_class'] ?? 'wow fadeInLeft',
            'animation_delay_ms' => $data['animation_delay_ms'] ?? 0,
            'sort_order' => $data['sort_order'],
            'is_active' => (bool) $data['is_active'],
        ]);

        $this->forgetCache();

        return back()->with('success', 'Item misi berhasil ditambahkan.');
    }

    public function update(Request $request, HomeMissionItem $item)
    {
        $data = $request->validate([
            'icon_class' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'animation_class' => ['nullable', 'string', 'max:255'],
            'animation_delay_ms' => ['nullable', 'integer', 'min:0', 'max:60000'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $item->icon_class = $data['icon_class'] ?? 'flaticon-architect';
        $item->title = $data['title'];
        $item->description = $data['description'] ?? null;
        $item->animation_class = $data['animation_class'] ?? 'wow fadeInLeft';
        $item->animation_delay_ms = $data['animation_delay_ms'] ?? 0;
        $item->sort_order = $data['sort_order'];
        $item->is_active = (bool) $data['is_active'];
        $item->save();

        $this->forgetCache();

        return back()->with('success', 'Item misi berhasil diperbarui.');
    }

    public function destroy(HomeMissionItem $item)
    {
        $item->delete();
        $this->forgetCache();

        return back()->with('success', 'Item misi berhasil dihapus.');
    }

    private function forgetCache(): void
    {
        Cache::forget('homepage:mission-items');
    }
}
