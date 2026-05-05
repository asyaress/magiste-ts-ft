<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teacher_sections', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();       // e.g. dosen-pengajar
            $table->string('subtitle')->nullable(); // teks kecil di atas judul
            $table->string('title');                // judul besar
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('teacher_sections');
    }
};
