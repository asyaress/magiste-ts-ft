<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GallerySection;
use App\Models\BlogSection;
use App\Models\HomeFaqItem;
use App\Models\HomeHeroSlide;
use App\Models\HomeMissionItem;

use App\Models\TeacherSection;
use App\Models\ResearchSection;
use App\Models\VideoGallerySection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $heroSlides = collect();
        $missionItems = collect();
        $faqItems = collect();

        if ($this->tableExists('home_hero_slides')) {
            $heroSlides = Cache::remember('homepage:hero-slides', 3600, function () {
                return HomeHeroSlide::query()
                    ->active()
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();
            });
        }

        if ($this->tableExists('home_mission_items')) {
            $missionItems = Cache::remember('homepage:mission-items', 3600, function () {
                return HomeMissionItem::query()
                    ->active()
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();
            });
        }

        if ($this->tableExists('home_faq_items')) {
            $faqItems = Cache::remember('homepage:faq-items', 3600, function () {
                return HomeFaqItem::query()
                    ->active()
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();
            });
        }

        $researchSection = Cache::remember('homepage:research-section', 3600, function () {
            return ResearchSection::with('topics')
                ->active()
                ->orderBy('sort_order')
                ->first();
        });

        $videoSection = Cache::remember('homepage:video-section', 3600, function () {
            return VideoGallerySection::with('items')
                ->active()
                ->orderBy('sort_order')
                ->first();
        });

        $gallerySection = Cache::remember('homepage:gallery-section', 3600, function () {
            return GallerySection::with('items')
                ->active()
                ->orderBy('sort_order')
                ->first();
        });

        $teacherSection = Cache::remember('homepage:teacher-section', 3600, function () {
            return TeacherSection::with('teachers')
                ->active()
                ->orderBy('sort_order')
                ->first();
        });

        $blogSection = Cache::remember('homepage:blog-section', 3600, function () {
            return BlogSection::with([
                'posts' => function ($q) {
                    $q->published()->orderByDesc('published_at')->orderBy('sort_order');
                }
            ])->active()->orderBy('sort_order')->first();
        });

        return view('pages.home', compact(
            'heroSlides',
            'missionItems',
            'faqItems',
            'researchSection',
            'videoSection',
            'gallerySection',
            'teacherSection',
            'blogSection'
        ));
    }

    private function tableExists(string $table): bool
    {
        try {
            return Schema::hasTable($table);
        } catch (\Throwable $e) {
            return false;
        }
    }
}
