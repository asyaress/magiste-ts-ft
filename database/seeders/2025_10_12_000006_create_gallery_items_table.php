<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_section_id')->constrained()->cascadeOnDelete();
            $table->string('title');                          // h3
            $table->string('slug')->index();                  // opsional untuk detail
            $table->string('category_label')->nullable();     // <p>Laboratorium / Studio / dst
            $table->string('icon_class')->nullable();         // flaticon-architect/manufacture/...
            $table->string('icon_color_class')->nullable();   // clr1, dst
            $table->string('image_path');                     // assets/images/gallery/...
            $table->string('image_alt')->nullable();          // alt gambar
            $table->string('overlay_link_path')->nullable();  // default pakai image_path
            $table->string('col_classes')->default('col-xl-4 col-lg-6 col-md-6'); // kontrol grid
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
    }
};
