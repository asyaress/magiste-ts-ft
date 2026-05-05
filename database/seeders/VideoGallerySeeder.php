<?php

namespace Database\Seeders;

use App\Models\VideoGallerySection;
use App\Models\VideoGalleryItem;
use Illuminate\Database\Seeder;

class VideoGallerySeeder extends Seeder
{
    public function run(): void
    {
        $section = VideoGallerySection::updateOrCreate(
            ['slug' => 'video-gallery'],
            [
                'title' => 'Company Video',
                'subtitle' => null,
                'background_image_path' => 'assets/images/resources/video-gallery-area-bg.jpg',
                'background_image_alt' => 'Video Gallery Background',
                'is_active' => true,
                'sort_order' => 0,
            ]
        );

        VideoGalleryItem::updateOrCreate(
            [
                'video_gallery_section_id' => $section->id,
                'title' => 'CarePress Video Gallery',
            ],
            [
                'video_gallery_section_id' => $section->id,
                'video_url' => 'https://www.youtube.com/watch?v=p25gICT63ek',
                'play_icon_class' => 'flaticon-play-button-1',
                'animation_delay_ms' => 300,
                'is_active' => true,
                'sort_order' => 1,
            ]
        );
    }
}
