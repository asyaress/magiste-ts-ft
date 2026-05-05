<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_mission_items', function (Blueprint $table) {
            $table->id();
            $table->string('icon_class')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('animation_class')->default('wow fadeInLeft');
            $table->unsignedSmallInteger('animation_delay_ms')->default(0);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $now = now();
        DB::table('home_mission_items')->insert([
            [
                'icon_class' => 'flaticon-architect',
                'title' => 'Pendidikan Berkualitas',
                'description' => 'Menyelenggarakan pendidikan magister teknik sipil yang berkualitas, berdaya saing global, dan berstandar internasional.',
                'animation_class' => 'wow fadeInLeft',
                'animation_delay_ms' => 0,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'icon_class' => 'flaticon-chemical',
                'title' => 'Riset Keilmuan',
                'description' => 'Mengaplikasikan dan menganalisis keilmuan bidang teknik sipil melalui kegiatan penelitian pada bidang teknik sipil.',
                'animation_class' => 'wow fadeInLeft',
                'animation_delay_ms' => 150,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'icon_class' => 'flaticon-garage-owner',
                'title' => 'Pengabdian & Kemitraan',
                'description' => 'Melaksanakan kegiatan pengabdian kepada masyarakat dengan menjalin kerjasama strategis dengan lembaga pemerintah maupun swasta.',
                'animation_class' => 'wow fadeInRight',
                'animation_delay_ms' => 0,
                'sort_order' => 3,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('home_mission_items');
    }
};
