<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blog_sections', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();               // e.g. blog-latest
            $table->string('subtitle')->nullable();         // sub-title text
            $table->string('title');                        // main title
            $table->string('button_text')->nullable();      // "View All Blog"
            $table->string('button_url')->nullable();       // link to blog index
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_sections');
    }
};
