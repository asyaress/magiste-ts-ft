<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('section')
            ->orderByDesc('published_at')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $sections = BlogSection::orderBy('sort_order')->get();

        // NOTE: di step berikutnya kamu akan punya views admin; di sini return view admin.index (akan dibuat nanti)
        return view('admin.blog-posts.index', compact('posts', 'sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'blog_section_id' => ['required', Rule::exists('blog_sections', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],

            'image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'overlay_icon_class' => ['nullable', 'string', 'max:255'],

            'author_name' => ['nullable', 'string', 'max:255'],
            'comment_count' => ['nullable', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['required', 'boolean'],

            'animation_duration_ms' => ['nullable', 'integer', 'min:0', 'max:60000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['overlay_icon_class'] = $data['overlay_icon_class'] ?: 'flaticon-plus';
        $data['animation_duration_ms'] = $data['animation_duration_ms'] ?? 1500;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blog/posts', 'public');
            $data['image_path'] = 'storage/' . $path;
        }

        $post = BlogPost::create([
            'blog_section_id' => $data['blog_section_id'],
            'title' => $data['title'],
            'slug' => $data['slug'],
            'excerpt' => $data['excerpt'] ?? null,
            'body' => $data['body'] ?? null,
            'image_path' => $data['image_path'] ?? null,
            'image_alt' => $data['image_alt'] ?? null,
            'overlay_icon_class' => $data['overlay_icon_class'],
            'author_name' => $data['author_name'] ?? null,
            'comment_count' => $data['comment_count'] ?? 0,
            'published_at' => $data['published_at'] ?? null,
            'is_published' => (bool) $data['is_published'],
            'animation_duration_ms' => $data['animation_duration_ms'],
            'sort_order' => $data['sort_order'],
        ]);

        $this->forgetBlogCache();

        return back()->with('success', 'Post berhasil ditambahkan.');
    }

    public function edit(BlogPost $post)
    {
        $sections = BlogSection::orderBy('sort_order')->get();
        return view('admin.blog-posts.edit', compact('post', 'sections'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $data = $request->validate([
            'blog_section_id' => ['required', Rule::exists('blog_sections', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],

            'image' => ['nullable', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
            'remove_image' => ['nullable', 'boolean'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'overlay_icon_class' => ['nullable', 'string', 'max:255'],

            'author_name' => ['nullable', 'string', 'max:255'],
            'comment_count' => ['nullable', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['required', 'boolean'],

            'animation_duration_ms' => ['nullable', 'integer', 'min:0', 'max:60000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $post->blog_section_id = $data['blog_section_id'];
        $post->title = $data['title'];
        $post->slug = $data['slug'] ?: Str::slug($data['title']);
        $post->excerpt = $data['excerpt'] ?? null;
        $post->body = $data['body'] ?? null;

        if (!empty($data['remove_image'])) {
            $this->deletePublicPath($post->image_path);
            $post->image_path = null;
        }
        if ($request->hasFile('image')) {
            $this->deletePublicPath($post->image_path);
            $path = $request->file('image')->store('blog/posts', 'public');
            $post->image_path = 'storage/' . $path;
        }

        $post->image_alt = $data['image_alt'] ?? null;
        $post->overlay_icon_class = $data['overlay_icon_class'] ?: 'flaticon-plus';

        $post->author_name = $data['author_name'] ?? null;
        $post->comment_count = $data['comment_count'] ?? 0;
        $post->published_at = $data['published_at'] ?? null;
        $post->is_published = (bool) $data['is_published'];

        $post->animation_duration_ms = $data['animation_duration_ms'] ?? 1500;
        $post->sort_order = $data['sort_order'] ?? 0;

        $post->save();

        $this->forgetBlogCache();

        return redirect()->route('admin.blog-posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(BlogPost $post)
    {
        $this->deletePublicPath($post->image_path);
        $post->delete();

        $this->forgetBlogCache();

        return back()->with('success', 'Post berhasil dihapus.');
    }

    public function uploadEditorImage(Request $request)
    {
        $data = $request->validate([
            'image' => ['required', 'file', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp,image/svg+xml'],
        ]);

        $path = $request->file('image')->store('blog/editor', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
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

    private function forgetBlogCache(): void
    {
        Cache::forget('homepage:blog-section');
    }
}
