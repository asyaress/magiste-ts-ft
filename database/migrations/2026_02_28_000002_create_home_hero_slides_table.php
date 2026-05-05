<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('kicker')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('background_image_path')->nullable();
            $table->string('primary_button_text')->nullable();
            $table->string('primary_button_url')->nullable();
            $table->string('secondary_button_text')->nullable();
            $table->string('secondary_button_url')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $now = now();
        DB::table('home_hero_slides')->insert([
            [
                'kicker' => null,
                'title' => 'Magister (S2) Teknik Sipil Universitas Mulawarman',
                'description' => 'Fokus pada infrastruktur berkelanjutan wilayah tropis & pedalaman, dengan keterlibatan langsung pada proyek nasional seperti IKN.',
                'background_image_path' => 'assets/images/depan1.png',
                'primary_button_text' => 'Daftar PMB',
                'primary_button_url' => 'https://pmb.unmul.ac.id/',
                'secondary_button_text' => 'Lihat Alur Pendaftaran',
                'secondary_button_url' => '#alur-pendaftaran-s2-sipil',
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'kicker' => 'S2 Teknik Sipil UNMUL',
                'title' => 'Fokus Riset: Struktur, Transportasi, Keairan & Geoteknik',
                'description' => 'Kuliah Jumat-Sabtu, 16 pertemuan, hybrid (maks. 50% daring), total 54 SKS.',
                'background_image_path' => 'assets/images/depan2.jpg',
                'primary_button_text' => 'Kurikulum 54 SKS',
                'primary_button_url' => '#kurikulum',
                'secondary_button_text' => 'Sistem Perkuliahan',
                'secondary_button_url' => '#sistem-perkuliahan',
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('home_hero_slides');
    }
};
