<?php

namespace Database\Seeders;

use App\Models\GallerySection;
use App\Models\GalleryItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $section = GallerySection::updateOrCreate(
            ['slug' => 'galeri'],
            [
                'subtitle' => 'Dokumentasi laboratorium, riset, kuliah tamu, dan pengabdian masyarakat Program Magister (S2) Teknik Sipil Universitas Mulawarman.',
                'title' => 'Galeri Kegiatan & Fasilitas',
                'button_text' => 'Lihat Semua Galeri',
                'button_url' => url('/galeri'),
                'is_active' => true,
                'sort_order' => 0,
            ]
        );

        $baseImg = 'assets/images/gallery/gallery-v1-4.jpg';

        $items = [
            [
                'title' => 'Laboratorium Struktur & Bahan',
                'category_label' => 'Laboratorium',
                'icon_class' => 'flaticon-architect',
                'icon_color_class' => 'clr1',
                'image_path' => $baseImg,
                'image_alt' => 'Pengujian beton & material di Laboratorium Struktur UNMUL',
                'overlay_link_path' => $baseImg,
                'sort_order' => 1,
            ],
            [
                'title' => 'Laboratorium Geoteknik',
                'category_label' => 'Laboratorium',
                'icon_class' => 'flaticon-manufacture',
                'icon_color_class' => 'clr1',
                'image_path' => $baseImg,
                'image_alt' => 'Uji tanah dan peralatan geoteknik',
                'overlay_link_path' => $baseImg,
                'sort_order' => 2,
            ],
            [
                'title' => 'Hidrolika & Sumber Daya Air',
                'category_label' => 'Laboratorium',
                'icon_class' => 'flaticon-chemical',
                'icon_color_class' => 'clr1',
                'image_path' => $baseImg,
                'image_alt' => 'Saluran uji dan instrumen hidrolika',
                'overlay_link_path' => $baseImg,
                'sort_order' => 3,
            ],
            [
                'title' => 'Transportasi & Perencanaan',
                'category_label' => 'Studio',
                'icon_class' => 'flaticon-car-parts',
                'icon_color_class' => 'clr1',
                'image_path' => $baseImg,
                'image_alt' => 'Pemodelan lalu lintas dan survei transportasi',
                'overlay_link_path' => $baseImg,
                'sort_order' => 4,
            ],
            [
                'title' => 'Seminar & Kuliah Tamu',
                'category_label' => 'Kegiatan Akademik',
                'icon_class' => 'flaticon-manufacture',
                'icon_color_class' => 'clr1',
                'image_path' => $baseImg,
                'image_alt' => 'Seminar dan kuliah tamu Magister Teknik Sipil UNMUL',
                'overlay_link_path' => $baseImg,
                'sort_order' => 5,
            ],
            [
                'title' => 'Pengabdian & Mitra IKN',
                'category_label' => 'Kolaborasi',
                'icon_class' => 'flaticon-architect',
                'icon_color_class' => 'clr1',
                'image_path' => $baseImg,
                'image_alt' => 'Kegiatan pengabdian masyarakat dan kolaborasi dengan mitra',
                'overlay_link_path' => $baseImg,
                'sort_order' => 6,
            ],
        ];

        foreach ($items as $i) {
            GalleryItem::updateOrCreate(
                [
                    'gallery_section_id' => $section->id,
                    'slug' => Str::slug($i['title']),
                ],
                array_merge($i, [
                    'gallery_section_id' => $section->id,
                    'col_classes' => 'col-xl-4 col-lg-6 col-md-6',
                    'is_active' => true,
                ])
            );
        }
    }
}
