<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('research_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_section_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->index();
            $table->text('description')->nullable();
            $table->string('icon_class')->nullable();         // e.g. flaticon-architect
            $table->string('bg_color_class')->nullable();     // e.g. bgclr1
            $table->string('image_path')->nullable();         // e.g. assets/images/project/project-v3-3.jpg
            $table->string('image_alt')->nullable();
            $table->string('gallery_image_path')->nullable(); // optional lightbox image
            $table->unsignedSmallInteger('animation_delay_ms')->default(0);
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_topics');
    }
};
