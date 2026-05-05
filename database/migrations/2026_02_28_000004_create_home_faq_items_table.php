<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_faq_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('step_number')->default(1);
            $table->string('title');
            $table->longText('content_html')->nullable();
            $table->boolean('is_open_by_default')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $now = now();
        DB::table('home_faq_items')->insert([
            [
                'step_number' => 1,
                'title' => 'Cek persyaratan & biaya',
                'content_html' => '<p>Kelulusan S1 bidang terkait, biaya pendaftaran dan UKT mengikuti ketentuan PMB terbaru.</p>',
                'is_open_by_default' => 1,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'step_number' => 2,
                'title' => 'Buat akun di laman PMB UNMUL',
                'content_html' => '<p>Kunjungi <a href="https://pmb.unmul.ac.id" target="_blank" rel="noopener">pmb.unmul.ac.id</a> dan lengkapi pendaftaran akun.</p>',
                'is_open_by_default' => 0,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'step_number' => 3,
                'title' => 'Lakukan pembayaran biaya pendaftaran',
                'content_html' => '<p>Bayar sesuai kode pembayaran pada bank mitra, simpan bukti untuk proses berikutnya.</p>',
                'is_open_by_default' => 0,
                'sort_order' => 3,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'step_number' => 4,
                'title' => 'Unggah berkas pendaftaran',
                'content_html' => '<p>Unggah formulir, ijazah/transkrip, CV, pas foto, dan dokumen pendukung lainnya sesuai ketentuan.</p>',
                'is_open_by_default' => 0,
                'sort_order' => 4,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'step_number' => 5,
                'title' => 'Pengumuman hasil & registrasi ulang',
                'content_html' => '<p>Pantau portal PMB untuk pengumuman hasil seleksi dan jadwal registrasi ulang.</p>',
                'is_open_by_default' => 0,
                'sort_order' => 5,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('home_faq_items');
    }
};
