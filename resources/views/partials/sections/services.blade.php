@php
    $missionItems = ($missionItems ?? collect())->values();

    if ($missionItems->isEmpty()) {
        $missionItems = collect([
            (object) [
                'icon_class' => 'flaticon-architect',
                'title' => 'Pendidikan Berkualitas',
                'description' => 'Menyelenggarakan pendidikan magister teknik sipil yang berkualitas, berdaya saing global, dan berstandar internasional.',
                'animation_class' => 'wow fadeInLeft',
                'animation_delay_ms' => 0,
            ],
            (object) [
                'icon_class' => 'flaticon-chemical',
                'title' => 'Riset Keilmuan',
                'description' => 'Mengaplikasikan dan menganalisis keilmuan bidang teknik sipil melalui kegiatan penelitian.',
                'animation_class' => 'wow fadeInLeft',
                'animation_delay_ms' => 150,
            ],
            (object) [
                'icon_class' => 'flaticon-garage-owner',
                'title' => 'Pengabdian & Kemitraan',
                'description' => 'Melaksanakan kegiatan pengabdian kepada masyarakat dengan menjalin kerjasama strategis.',
                'animation_class' => 'wow fadeInRight',
                'animation_delay_ms' => 0,
            ],
        ]);
    }
@endphp

<section class="service-style2-area bg_white" id="visi-misi">
    <div class="parallax-scene parallax-scene-5">
        <div data-depth="0.20" class="parallax-layer shape">
            <div class="shape1">
                <img class="paroller" src="{{ asset('assets/images/shape/shape-bg-1.png') }}" alt="Elemen dekoratif latar">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="service-style2_top_box">
                    <div class="sec-title">
                        <div class="sub-title"><h5>{{ $siteSettings['service_section_subtitle'] ?? 'Visi & Misi' }}</h5></div>
                        <h2>
                            {{ $siteSettings['service_section_title_line1'] ?? 'Program Magister (S2) Teknik Sipil' }}<br>
                            <span>{{ $siteSettings['service_section_title_line2'] ?? 'Universitas Mulawarman' }}</span>
                        </h2>
                    </div>

                    <div class="text_box">
                        <div class="top">
                            <p><strong>Visi:</strong> {{ $siteSettings['service_section_vision_text'] ?? 'Menjadi program studi Magister (S2) Teknik Sipil yang menghasilkan lulusan berintegritas, inovatif, adaptif dan profesional, serta berkelanjutan.' }}</p>
                        </div>
                        <div class="bottom">
                            <p><strong>Misi:</strong> {{ $siteSettings['service_section_mission_intro'] ?? 'Untuk mewujudkan visi tersebut, Program S2 Teknik Sipil Universitas Mulawarman melaksanakan misi sebagai berikut.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($missionItems as $item)
                <div class="col-xl-4 col-lg-6 col-md-6 {{ $item->animation_class }}" data-wow-delay="{{ $item->animation_delay_ms }}ms"
                    data-wow-duration="1500ms">
                    <div class="single-service-style2 text-center">
                        <div class="icon-holder">
                            <span class="{{ $item->icon_class }}" aria-hidden="true"></span>
                        </div>
                        <div class="text-holder">
                            <h3><a href="#">{{ $item->title }}</a></h3>
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
