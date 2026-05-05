<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_section_id')->constrained()->cascadeOnDelete();

            $table->string('title');
            $table->string('slug')->index();
            $table->string('excerpt')->nullable();          // short summary for list
            $table->longText('body')->nullable();           // full content (optional for sekarang)

            $table->string('image_path')->nullable();       // assets/... or storage/...
            $table->string('image_alt')->nullable();
            $table->string('overlay_icon_class')->default('flaticon-plus');

            $table->string('author_name')->nullable();
            $table->unsignedInteger('comment_count')->default(0);
            $table->dateTime('published_at')->nullable();
            $table->boolean('is_published')->default(false);

            $table->unsignedSmallInteger('animation_duration_ms')->default(1500);
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
