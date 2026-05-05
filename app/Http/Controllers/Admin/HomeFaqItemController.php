<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeFaqItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeFaqItemController extends Controller
{
    public function index()
    {
        $items = HomeFaqItem::query()->orderBy('sort_order')->orderBy('id')->get();
        return view('admin.home-faq-items.index', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'step_number' => ['required', 'integer', 'min:1', 'max:999'],
            'title' => ['required', 'string', 'max:255'],
            'content_html' => ['nullable', 'string'],
            'is_open_by_default' => ['nullable', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        HomeFaqItem::create([
            'step_number' => $data['step_number'],
            'title' => $data['title'],
            'content_html' => $data['content_html'] ?? null,
            'is_open_by_default' => !empty($data['is_open_by_default']),
            'sort_order' => $data['sort_order'],
            'is_active' => (bool) $data['is_active'],
        ]);

        $this->forgetCache();

        return back()->with('success', 'Item FAQ berhasil ditambahkan.');
    }

    public function update(Request $request, HomeFaqItem $item)
    {
        $data = $request->validate([
            'step_number' => ['required', 'integer', 'min:1', 'max:999'],
            'title' => ['required', 'string', 'max:255'],
            'content_html' => ['nullable', 'string'],
            'is_open_by_default' => ['nullable', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $item->step_number = $data['step_number'];
        $item->title = $data['title'];
        $item->content_html = $data['content_html'] ?? null;
        $item->is_open_by_default = !empty($data['is_open_by_default']);
        $item->sort_order = $data['sort_order'];
        $item->is_active = (bool) $data['is_active'];
        $item->save();

        $this->forgetCache();

        return back()->with('success', 'Item FAQ berhasil diperbarui.');
    }

    public function destroy(HomeFaqItem $item)
    {
        $item->delete();
        $this->forgetCache();

        return back()->with('success', 'Item FAQ berhasil dihapus.');
    }

    private function forgetCache(): void
    {
        Cache::forget('homepage:faq-items');
    }
}
