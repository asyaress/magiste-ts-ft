<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::query()
            ->published()
            ->orderByDesc('published_at')
            ->orderBy('sort_order')
            ->paginate(9);

        return view('pages.blog.index', compact('posts'));
    }

    public function show(BlogPost $post)
    {
        if (!$post->is_published || !$post->published_at) {
            abort(404);
        }

        $latestPosts = BlogPost::query()
            ->published()
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();

        return view('pages.blog.show', compact('post', 'latestPosts'));
    }
}
