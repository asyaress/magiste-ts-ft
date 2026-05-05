<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\GalleryItem;
use App\Models\HomeFaqItem;
use App\Models\HomeHeroSlide;
use App\Models\HomeMissionItem;
use App\Models\ResearchTopic;
use App\Models\Teacher;
use App\Models\VideoGalleryItem;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'hero_slides' => HomeHeroSlide::query()->count(),
            'mission_items' => HomeMissionItem::query()->count(),
            'faq_items' => HomeFaqItem::query()->count(),
            'research_topics' => ResearchTopic::query()->count(),
            'video_items' => VideoGalleryItem::query()->count(),
            'gallery_items' => GalleryItem::query()->count(),
            'teachers' => Teacher::query()->count(),
            'blog_posts' => BlogPost::query()->count(),
            'blog_published' => BlogPost::query()->where('is_published', true)->whereNotNull('published_at')->count(),
        ];

        $latestPosts = BlogPost::query()
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'latestPosts'));
    }
}

