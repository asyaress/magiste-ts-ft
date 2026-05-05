<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_section_id')->constrained()->cascadeOnDelete();

            $table->string('name');                // h3
            $table->string('slug')->index();       // opsional untuk detail
            $table->string('tagline')->nullable(); // <p> di bawah nama (jabatan / bidang)

            $table->string('photo_path')->nullable(); // assets/images/team/xxx.jpg atau storage/xxx
            $table->string('photo_alt')->nullable();

            // tautan
            $table->string('profile_url')->nullable();  // untuk <a href="#"> pada overlay dan nama
            $table->string('linkedin_url')->nullable();
            $table->string('scholar_url')->nullable();
            $table->string('website_url')->nullable();

            // layout & animasi
            $table->string('col_classes')->default('col-xl-3 col-lg-6 col-md-6');
            $table->string('wow_animation_class')->default('wow fadeInUp'); // fadeInUp / fadeInDown
            $table->unsignedSmallInteger('animation_delay_ms')->default(100);
            $table->unsignedSmallInteger('animation_duration_ms')->default(1500);

            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
