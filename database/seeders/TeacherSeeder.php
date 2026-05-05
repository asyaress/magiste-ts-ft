<?php

namespace Database\Seeders;

use App\Models\TeacherSection;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $section = TeacherSection::updateOrCreate(
            ['slug' => 'dosen-pengajar'],
            [
                'subtitle' => 'Profil singkat tim pengajar Magister (S2) Teknik Sipil Universitas Mulawarman.',
                'title' => 'Dosen Pengajar',
                'is_active' => true,
                'sort_order' => 0,
            ]
        );

        // gunakan file: public/assets/images/team/dosen{1..9}.jpg
        $p = fn($n) => "assets/images/team/{$n}.png";

        $items = [
            [
                'name' => 'Prof. Dr. Ir. H. Tamrin, S.T., M.T. IPU. ASEAN Eng. APEC Eng.',
                'tagline' => 'Guru Besar — Hidrologi & Sumber Daya Air; Dekan FT UNMUL (2024)',
                'photo_path' => $p(1),
                'photo_alt' => 'Prof. Dr. Ir. H. Tamrin — Hidrologi & SDA',
                'profile_url' => 'https://orasi.unmul.ac.id/web/guru-besar/prof-dr-ir-tamrin-st-mt',
                'linkedin_url' => '#',
                'scholar_url' => 'https://scholar.google.com/citations?user=KXoZTgoAAAAJ',
                'website_url' => 'https://ts.ft.unmul.ac.id/list/all-dosen',
                'wow_animation_class' => 'wow fadeInUp',
                'animation_delay_ms' => 100,
                'animation_duration_ms' => 1500,
                'sort_order' => 1,
            ],
            [
                'name' => 'Dr. Ir. Hj. Mardewi Jamal, S.T., M.T. IPM.',
                'tagline' => 'Rekayasa Struktur — Kepala Laboratorium Rekayasa Sipil',
                'photo_path' => $p(2),
                'photo_alt' => 'Dr. Ir. Hj. Mardewi Jamal — Struktur',
                'profile_url' => 'https://labrek.sipil.ft.unmul.ac.id/',
                'linkedin_url' => '#',
                'scholar_url' => 'https://scholar.google.com/citations?user=dlYvnEcAAAAJ',
                'website_url' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6156620/?view=garuda',
                'wow_animation_class' => 'wow fadeInDown',
                'animation_delay_ms' => 200,
                'animation_duration_ms' => 1500,
                'sort_order' => 2,
            ],
            [
                'name' => 'Dr. Ir. Ery Budiman, S.T., M.T. IPM.',
                'tagline' => 'Struktur — riset terowongan apung/pipa bawah laut',
                'photo_path' => $p(3),
                'photo_alt' => 'Dr. Ir. Ery Budiman — Struktur',
                'profile_url' => 'https://ts.ft.unmul.ac.id/list/all-dosen',
                'linkedin_url' => '#',
                'scholar_url' => 'https://scholar.google.com/citations?user=sguZPdEAAAAJ',
                'website_url' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6156776/?view=garuda',
                'wow_animation_class' => 'wow fadeInUp',
                'animation_delay_ms' => 300,
                'animation_duration_ms' => 1500,
                'sort_order' => 3,
            ],
            [
                'name' => 'Dr. Ir. Tiopan Henry Manto Gultom, S.T., M.T.',
                'tagline' => 'Manajemen Konstruksi & Transportasi',
                'photo_path' => $p(4),
                'photo_alt' => 'Dr. Ir. Tiopan Henry Manto Gultom — Manajemen Konstruksi',
                'profile_url' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6680512',
                'linkedin_url' => '#',
                'scholar_url' => 'https://scholar.google.com/citations?user=c76IU8YAAAAJ',
                'website_url' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6680512',
                'wow_animation_class' => 'wow fadeInDown',
                'animation_delay_ms' => 400,
                'animation_duration_ms' => 1500,
                'sort_order' => 4,
            ],
            [
                'name' => 'Dr. Ir. Johannes E. Simangunsong, S.T., M.T.',
                'tagline' => 'Transportasi — perencanaan & kinerja layanan',
                'photo_path' => $p(5),
                'photo_alt' => 'Dr. Ir. Johannes E. Simangunsong — Transportasi',
                'profile_url' => 'https://ts.ft.unmul.ac.id/list/all-dosen',
                'linkedin_url' => '#',
                'scholar_url' => 'https://scholar.google.com/citations?user=ykxLfSIAAAAJ',
                'website_url' => '#',
                'wow_animation_class' => 'wow fadeInUp',
                'animation_delay_ms' => 500,
                'animation_duration_ms' => 1500,
                'sort_order' => 5,
            ],
            [
                'name' => 'Dr. Ir. Ruminsar Simbolon, S.T., M.T.',
                'tagline' => 'Struktur',
                'photo_path' => $p(6),
                'photo_alt' => 'Dr. Ir. Ruminsar Simbolon — Struktur',
                'profile_url' => 'https://ts.ft.unmul.ac.id/list/all-dosen',
                'linkedin_url' => '#',
                'scholar_url' => '#',
                'website_url' => 'https://www.datadikti.com/dosen/ruminsar-simbolon/s1-teknik-sipil/universitas-mulawarman/',
                'wow_animation_class' => 'wow fadeInDown',
                'animation_delay_ms' => 600,
                'animation_duration_ms' => 1500,
                'sort_order' => 6,
            ],
            [
                'name' => 'Dr. Ir. Hj. Revia Oktaviani, S.T., M.T.',
                'tagline' => 'Geoteknik — ketahanan lereng & batuan',
                'photo_path' => $p(7),
                'photo_alt' => 'Dr. Ir. Hj. Revia Oktaviani — Geoteknik',
                'profile_url' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6713087',
                'linkedin_url' => '#',
                'scholar_url' => 'https://scholar.google.com/citations?user=i3_30AkAAAAJ',
                'website_url' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6713087',
                'wow_animation_class' => 'wow fadeInUp',
                'animation_delay_ms' => 700,
                'animation_duration_ms' => 1500,
                'sort_order' => 7,
            ],
            [
                'name' => 'Dr. Ir. Shalaho Dina Devy, S.T., M.Eng.',
                'tagline' => 'Hidrogeologi & Pemodelan Air Tanah',
                'photo_path' => $p(8),
                'photo_alt' => 'Dr. Ir. Shalaho Dina Devy — Hidrogeologi',
                'profile_url' => 'https://sinta.kemdiktisaintek.go.id/authors/profile/6142460',
                'linkedin_url' => '#',
                'scholar_url' => 'https://scholar.google.com/citations?user=gC4b9Z4AAAAJ',
                'website_url' => 'https://repository.unmul.ac.id/bitstream/handle/123456789/27140/16-Shalaho%20Dina%20Devy.pdf',
                'wow_animation_class' => 'wow fadeInDown',
                'animation_delay_ms' => 800,
                'animation_duration_ms' => 1500,
                'sort_order' => 8,
            ],
            [
                'name' => 'Dr. Sc. Mustaid Yusuf, M.Si',
                'tagline' => 'Hidro-Oseanografi & Pemodelan Oseanografi (FMIPA UNMUL)',
                'photo_path' => $p(9),
                'photo_alt' => 'Dr. Sc. Mustaid Yusuf — Hidro-Oseanografi',
                'profile_url' => 'https://geophysics.fmipa.unmul.ac.id/page?content=Dosen',
                'linkedin_url' => '#',
                'scholar_url' => 'https://scholar.google.com/citations?user=c9IHjWQAAAAJ',
                'website_url' => 'https://geophysics.fmipa.unmul.ac.id/page?content=Dosen',
                'wow_animation_class' => 'wow fadeInUp',
                'animation_delay_ms' => 900,
                'animation_duration_ms' => 1500,
                'sort_order' => 9,
            ],
        ];

        foreach ($items as $i) {
            Teacher::updateOrCreate(
                [
                    'teacher_section_id' => $section->id,
                    'slug' => Str::slug($i['name']),
                ],
                array_merge($i, [
                    'teacher_section_id' => $section->id,
                    'col_classes' => 'col-xl-3 col-lg-6 col-md-6',
                    'is_active' => true,
                ])
            );
        }
    }
}
