<?php

namespace Database\Seeders;

use App\Models\BlogSection;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $section = BlogSection::updateOrCreate(
            ['slug' => 'blog-latest'],
            [
                'subtitle' => 'Informasi terbaru seputar kegiatan akademik, riset, dan prestasi Magister Teknik Sipil FT Unmul.',
                'title' => 'Berita Terbaru',
                'button_text' => 'Lihat Semua Berita',
                'button_url' => url('/blog'),
                'is_active' => true,
                'sort_order' => 0,
            ]
        );

        $images = [
            'assets/images/blog/blog-v1-1.jpg',
            'assets/images/blog/blog-v1-2.jpg',
            'assets/images/blog/blog-v1-3.jpg',
        ];

        $titles = [
            'Models & OEM Solutions | Simul Corporation.',
            'Innovations in Smart Mobility & ITS Research.',
            'Hydroinformatics for Flood Early Warning Systems.',
        ];

        foreach ($titles as $i => $title) {
            BlogPost::updateOrCreate(
                ['blog_section_id' => $section->id, 'slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'excerpt' => 'There are many variations of passages of Lorem Ipsum available variations.',
                    'body' => null,
                    'image_path' => $images[$i % count($images)],
                    'image_alt' => $title,
                    'overlay_icon_class' => 'flaticon-plus',
                    'author_name' => 'Editor',
                    'comment_count' => 2,
                    'published_at' => Carbon::now()->subDays(3 - $i),
                    'is_published' => true,
                    'animation_duration_ms' => 1500,
                    'sort_order' => $i + 1,
                ]
            );
        }
    }
}
