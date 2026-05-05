<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gallery_sections', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();                 // e.g. 'galeri'
            $table->string('subtitle')->nullable();           // teks kecil di atas judul
            $table->string('title');                          // judul besar
            $table->string('button_text')->nullable();        // "Lihat Semua Galeri"
            $table->string('button_url')->nullable();         // link tombol
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_sections');
    }
};
