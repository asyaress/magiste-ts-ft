@php
    $toUrl = function (?string $path): ?string {
        if (!$path) {
            return null;
        }
        return \Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '/']) ? $path : asset($path);
    };

    $slides = ($heroSlides ?? collect())->values();

    if ($slides->isEmpty()) {
        $slides = collect([
            (object) [
                'kicker' => null,
                'title' => "Magister (S2) Teknik Sipil\nUniversitas Mulawarman",
                'description' => 'Fokus pada infrastruktur berkelanjutan wilayah tropis & pedalaman, dengan keterlibatan langsung pada proyek nasional seperti IKN.',
                'background_image_path' => 'assets/images/depan1.png',
                'primary_button_text' => 'Daftar PMB',
                'primary_button_url' => 'https://pmb.unmul.ac.id/',
                'secondary_button_text' => 'Lihat Alur Pendaftaran',
                'secondary_button_url' => '#alur-pendaftaran-s2-sipil',
            ],
            (object) [
                'kicker' => 'S2 Teknik Sipil UNMUL',
                'title' => 'Fokus Riset: Struktur, Transportasi, Keairan & Geoteknik',
                'description' => 'Kuliah Jumat-Sabtu, 16 pertemuan, hybrid (maks. 50% daring), total 54 SKS.',
                'background_image_path' => 'assets/images/depan2.jpg',
                'primary_button_text' => 'Kurikulum 54 SKS',
                'primary_button_url' => '#kurikulum',
                'secondary_button_text' => 'Sistem Perkuliahan',
                'secondary_button_url' => '#sistem-perkuliahan',
            ],
        ]);
    }
@endphp

<section class="main-slider style4">
    <div class="slider-box">
        <div class="banner-carousel owl-theme owl-carousel">
            @foreach($slides as $slide)
                <div class="slide">
                    <div class="image-layer" style="background-image: url('{{ $toUrl($slide->background_image_path) }}');"></div>
                    <div class="auto-container">
                        <div class="content">
                            @if(!empty($slide->kicker))
                                <div class="sub-title"><h4>{{ $slide->kicker }}</h4></div>
                            @endif
                            <div class="big-title">
                                <h2>{!! nl2br(e($slide->title)) !!}</h2>
                            </div>
                            @if(!empty($slide->description))
                                <h3>{{ $slide->description }}</h3>
                            @endif

                            @if(!empty($slide->primary_button_text) || !empty($slide->secondary_button_text))
                                <div class="btns-box">
                                    @if(!empty($slide->primary_button_text))
                                        <div class="left">
                                            <a class="btn-one style2" href="{{ $slide->primary_button_url ?: '#' }}">
                                                <span class="txt">{{ $slide->primary_button_text }}<i class="flaticon-right-arrow-1 arrow1"></i></span>
                                            </a>
                                        </div>
                                    @endif
                                    @if(!empty($slide->secondary_button_text))
                                        <div class="right">
                                            <a class="btn-one" href="{{ $slide->secondary_button_url ?: '#' }}">
                                                <span class="txt">{{ $slide->secondary_button_text }}<i class="flaticon-right-arrow-1 arrow1"></i></span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
