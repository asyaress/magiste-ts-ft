<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        $now = now();
        $rows = [
            ['key' => 'contact_whatsapp', 'value' => '08xx-xxxx-xxxx'],
            ['key' => 'contact_email', 'value' => 'email@unmul.ac.id'],
            ['key' => 'contact_link_url', 'value' => 'https://wa.me/'],
            ['key' => 'header_location_label', 'value' => 'Lokasi Kampus'],
            ['key' => 'header_location_text', 'value' => "Gedung Fakultas Teknik, Jl. Sambaliung No.9\nKampus Gunung Kelua, Samarinda"],
            ['key' => 'header_cta_text', 'value' => 'Hubungi Kami'],

            ['key' => 'social_facebook', 'value' => 'https://facebook.com/'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/'],

            ['key' => 'footer_about_text', 'value' => 'Program Studi Magister (S2) Teknik Sipil Universitas Mulawarman.'],
            ['key' => 'footer_contact_title', 'value' => 'Kontak & Lokasi'],
            ['key' => 'footer_contact_address_html', 'value' => '<address class="mb-2"><strong>Fakultas Teknik UNMUL</strong><br>Gedung Fakultas Teknik, Jl. Sambaliung No.9<br>Kampus Gunung Kelua, Kota Samarinda</address>'],
            ['key' => 'footer_contact_note', 'value' => 'Sistem kuliah: 16x pertemuan (14 materi, 2 UTS/UAS), metode luring & daring (maks. 50% daring).'],

            ['key' => 'service_section_subtitle', 'value' => 'Visi & Misi'],
            ['key' => 'service_section_title_line1', 'value' => 'Program Magister (S2) Teknik Sipil'],
            ['key' => 'service_section_title_line2', 'value' => 'Universitas Mulawarman'],
            ['key' => 'service_section_vision_text', 'value' => 'Menjadi program studi Magister (S2) Teknik Sipil yang menghasilkan lulusan berintegritas, inovatif, adaptif dan profesional, serta berkelanjutan.'],
            ['key' => 'service_section_mission_intro', 'value' => 'Untuk mewujudkan visi tersebut, Program S2 Teknik Sipil Universitas Mulawarman melaksanakan misi sebagai berikut.'],

            ['key' => 'about_section_subtitle', 'value' => 'Tentang Program'],
            ['key' => 'about_section_title_line1', 'value' => 'Magister (S2) Teknik Sipil'],
            ['key' => 'about_section_title_line2', 'value' => 'Universitas Mulawarman'],
            ['key' => 'about_section_headline', 'value' => 'Mencetak pemimpin rekayasa sipil berintegritas untuk infrastruktur berkelanjutan di Kalimantan Timur dan Indonesia.'],
            ['key' => 'about_stat_1_value', 'value' => '24'],
            ['key' => 'about_stat_1_label', 'value' => 'Dosen'],
            ['key' => 'about_stat_2_value', 'value' => '180+'],
            ['key' => 'about_stat_2_label', 'value' => 'Mahasiswa Aktif'],
            ['key' => 'about_stat_3_value', 'value' => '6'],
            ['key' => 'about_stat_3_label', 'value' => 'Laboratorium'],
            ['key' => 'about_image_path', 'value' => 'assets/images/depan4.png'],
            ['key' => 'about_image_alt', 'value' => 'Aktivitas akademik Magister Teknik Sipil UNMUL'],

            ['key' => 'faq_section_subtitle', 'value' => 'Alur Pendaftaran & Ketentuan'],
            ['key' => 'faq_section_title_line1', 'value' => 'Langkah-langkah Pendaftaran'],
            ['key' => 'faq_section_title_line2', 'value' => '- S2 Teknik Sipil UNMUL'],
            ['key' => 'faq_image_path', 'value' => 'assets/images/depan5.jpg'],
            ['key' => 'faq_image_alt', 'value' => 'Alur Pendaftaran S2 Teknik Sipil Universitas Mulawarman'],
        ];

        $rows = array_map(function ($row) use ($now) {
            $row['created_at'] = $now;
            $row['updated_at'] = $now;
            return $row;
        }, $rows);

        DB::table('site_settings')->insert($rows);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
