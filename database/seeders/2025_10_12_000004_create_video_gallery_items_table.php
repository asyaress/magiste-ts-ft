<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('video_gallery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_gallery_section_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('video_url');
            $table->string('play_icon_class')->default('flaticon-play-button-1');
            $table->unsignedSmallInteger('animation_delay_ms')->default(300);
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_gallery_items');
    }
};
