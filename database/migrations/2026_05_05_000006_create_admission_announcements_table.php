<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admission_announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('subtitle', 255)->nullable();
            $table->string('image_path', 2048)->nullable();
            $table->string('image_alt', 255)->nullable();
            $table->string('button_text', 120)->nullable();
            $table->string('button_url', 2048)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_announcements');
    }
};

