<?php

namespace Database\Seeders;

use App\Models\ResearchSection;
use App\Models\ResearchTopic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ResearchSeeder extends Seeder
{
    public function run(): void
    {
        $section = ResearchSection::updateOrCreate(
            ['slug' => 'riset-tesis'],
            [
                'subtitle' => 'Klaster riset dan tema tesis Magister (S2) Teknik Sipil Universitas Mulawarman.',
                'title' => 'Riset & Tesis Unggulan',
                'button_text' => 'Lihat Semua Topik Riset',
                'button_url' => url('/riset-tesis'), // ubah ke halaman “semua topik” kalau ada
                'is_active' => true,
                'sort_order' => 0,
            ]
        );

        $items = [
            [
                'title' => 'Struktur & Material Cerdas',
                'description' => 'Beton kinerja tinggi, SHM, pemodelan numerik, optimasi desain.',
                'icon_class' => 'flaticon-architect',
                'bg_color_class' => 'bgclr1',
                'image_path' => 'assets/images/project/project-v3-3.jpg',
                'image_alt' => 'Riset Struktur & Material Cerdas',
                'animation_delay_ms' => 0,
                'sort_order' => 1,
            ],
            [
                'title' => 'Geoteknik & Ketahanan Bencana',
                'description' => 'Stabilitas lereng, tanah lunak, geosintetik, mikrozonasi & likuefaksi.',
                'icon_class' => 'flaticon-manufacture',
                'bg_color_class' => 'bgclr1',
                'image_path' => 'assets/images/project/project-v3-3.jpg',
                'image_alt' => 'Riset Geoteknik & Ketahanan Bencana',
                'animation_delay_ms' => 100,
                'sort_order' => 2,
            ],
            [
                'title' => 'Transportasi & Smart Mobility',
                'description' => 'Keselamatan jalan, kinerja simpang, TDM, ITS, permodelan permintaan.',
                'icon_class' => 'flaticon-car-parts',
                'bg_color_class' => 'bgclr1',
                'image_path' => 'assets/images/project/project-v3-3.jpg',
                'image_alt' => 'Riset Transportasi & Smart Mobility',
                'animation_delay_ms' => 150,
                'sort_order' => 3,
            ],
            [
                'title' => 'Sumber Daya Air & Hidroinformatika',
                'description' => 'Banjir & drainase, sungai, hidrologi, dampak perubahan iklim.',
                'icon_class' => 'flaticon-chemical',
                'bg_color_class' => 'bgclr1',
                'image_path' => 'assets/images/project/project-v3-3.jpg',
                'image_alt' => 'Riset Sumber Daya Air & Hidroinformatika',
                'animation_delay_ms' => 200,
                'sort_order' => 4,
            ],
        ];

        foreach ($items as $i) {
            ResearchTopic::updateOrCreate(
                [
                    'research_section_id' => $section->id,
                    'slug' => Str::slug($i['title']),
                ],
                array_merge($i, [
                    'research_section_id' => $section->id,
                    'is_active' => true,
                ])
            );
        }
    }
}
