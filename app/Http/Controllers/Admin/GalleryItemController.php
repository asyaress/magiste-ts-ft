<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\GallerySection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GalleryItemController extends Controller
{
    public function index()
    {
        $items = GalleryItem::with('section')
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->get();

        $sections = GallerySection::orderBy('sort_order')->get();

        return view('admin.gallery-items.index', compact('items', 'sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'gallery_section_id' => ['required', Rule::exists('gallery_sections', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'category_label' => ['nullable', 'string', 'max:255'],
            'icon_class' => ['nullable', 'string', 'max:255'],
            'icon_color_class' => ['nullable', 'string', 'max:255'],
            'col_classes' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'overlay_image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'overlay_link_url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $data['slug'] = filled($data['slug'] ?? null) ? $data['slug'] : Str::slug($data['title']);
        $data['col_classes'] = filled($data['col_classes'] ?? null) ? $data['col_classes'] : 'col-xl-4 col-lg-6 col-md-6';

        // upload image utama
        $imagePath = $request->file('image')->store('gallery/items', 'public');
        $imagePublic = 'storage/' . $imagePath;

        // overlay: pakai file jika ada, kalau tidak pakai URL, kalau kosong default ke image utama
        $overlayPublic = null;
        if ($request->hasFile('overlay_image')) {
            $overlayPath = $request->file('overlay_image')->store('gallery/items', 'public');
            $overlayPublic = 'storage/' . $overlayPath;
        } elseif (!empty($data['overlay_link_url'])) {
            $overlayPublic = $data['overlay_link_url'];
        }

        $item = GalleryItem::create([
            'gallery_section_id' => $data['gallery_section_id'],
            'title' => $data['title'],
            'slug' => $data['slug'],
            'category_label' => $data['category_label'] ?? null,
            'icon_class' => $data['icon_class'] ?? null,
            'icon_color_class' => $data['icon_color_class'] ?? null,
            'image_path' => $imagePublic,
            'image_alt' => $data['image_alt'] ?? null,
            'overlay_link_path' => $overlayPublic, // boleh null; FE akan fallback ke image
            'col_classes' => $data['col_classes'],
            'sort_order' => $data['sort_order'],
            'is_active' => (bool) $data['is_active'],
        ]);

        $this->forgetGalleryCache();

        return back()->with('success', 'Item galeri berhasil ditambahkan.');
    }

    public function edit(GalleryItem $item)
    {
        $sections = GallerySection::orderBy('sort_order')->get();
        return view('admin.gallery-items.edit', compact('item', 'sections'));
    }

    public function update(Request $request, GalleryItem $item)
    {
        $data = $request->validate([
            'gallery_section_id' => ['required', Rule::exists('gallery_sections', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'category_label' => ['nullable', 'string', 'max:255'],
            'icon_class' => ['nullable', 'string', 'max:255'],
            'icon_color_class' => ['nullable', 'string', 'max:255'],
            'col_classes' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'remove_image' => ['nullable', 'boolean'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'overlay_image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'overlay_link_url' => ['nullable', 'url', 'max:2048'],
            'remove_overlay' => ['nullable', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $item->gallery_section_id = $data['gallery_section_id'];
        $item->title = $data['title'];
        $item->slug = filled($data['slug'] ?? null) ? $data['slug'] : Str::slug($data['title']);
        $item->category_label = $data['category_label'] ?? null;
        $item->icon_class = $data['icon_class'] ?? null;
        $item->icon_color_class = $data['icon_color_class'] ?? null;
        $item->col_classes = filled($data['col_classes'] ?? null) ? $data['col_classes'] : 'col-xl-4 col-lg-6 col-md-6';
        $item->image_alt = $data['image_alt'] ?? null;
        $item->sort_order = $data['sort_order'];
        $item->is_active = (bool) $data['is_active'];

        // gambar utama
        if (!empty($data['remove_image'])) {
            $this->deletePublicPath($item->image_path);
            $item->image_path = null; // NOTE: kolom tidak nullable; pastikan ganti dengan image baru sebelum save jika remove_image dicentang
        }
        if ($request->hasFile('image')) {
            $this->deletePublicPath($item->image_path);
            $path = $request->file('image')->store('gallery/items', 'public');
            $item->image_path = 'storage/' . $path;
        }

        // pastikan tidak menyimpan null pada kolom wajib
        if (!$item->image_path) {
            return back()->withErrors(['image' => 'Gambar utama wajib diisi.'])->withInput();
        }

        // overlay
        if (!empty($data['remove_overlay'])) {
            // hanya hapus file jika local storage
            $this->deletePublicPath($item->overlay_link_path);
            $item->overlay_link_path = null;
        }
        if ($request->hasFile('overlay_image')) {
            $this->deletePublicPath($item->overlay_link_path);
            $overlayPath = $request->file('overlay_image')->store('gallery/items', 'public');
            $item->overlay_link_path = 'storage/' . $overlayPath;
        } elseif (!empty($data['overlay_link_url'])) {
            $item->overlay_link_path = $data['overlay_link_url'];
        }

        $item->save();

        // bust cache
        $this->forgetGalleryCache();

        return redirect()->route('admin.gallery-items.index')->with('success', 'Item galeri berhasil diperbarui.');
    }

    public function destroy(GalleryItem $item)
    {
        $this->deletePublicPath($item->image_path);
        $this->deletePublicPath($item->overlay_link_path);

        $item->delete();

        $this->forgetGalleryCache();

        return back()->with('success', 'Item galeri berhasil dihapus.');
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

    private function forgetGalleryCache(): void
    {
        Cache::forget('homepage:gallery-section');
    }
}
