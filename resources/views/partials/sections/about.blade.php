@php
    $toUrl = function (?string $path): ?string {
        if (!$path) {
            return null;
        }
        return \Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '/']) ? $path : asset($path);
    };
@endphp

<section class="about-style3-area about-style4-area" id="tentang-program">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="about-style3-content-box about-style4-content-box text-right-rtl">
                    <div class="text-holder">
                        <div class="sec-title">
                            <div class="sub-title"><h5>{{ $siteSettings['about_section_subtitle'] ?? 'Tentang Program' }}</h5></div>
                            <h2>{{ $siteSettings['about_section_title_line1'] ?? 'Magister (S2) Teknik Sipil' }}<br> {{ $siteSettings['about_section_title_line2'] ?? 'Universitas Mulawarman' }}</h2>
                        </div>

                        <div class="inner-content">
                            <h3>{{ $siteSettings['about_section_headline'] ?? 'Mencetak pemimpin rekayasa sipil berintegritas untuk infrastruktur berkelanjutan di Kalimantan Timur dan Indonesia.' }}</h3>
                            <ul class="bgclr1 about-stats">
                                <li><span>{{ $siteSettings['about_stat_1_value'] ?? '24' }}</span> {{ $siteSettings['about_stat_1_label'] ?? 'Dosen' }}</li>
                                <li><span>{{ $siteSettings['about_stat_2_value'] ?? '180+' }}</span> {{ $siteSettings['about_stat_2_label'] ?? 'Mahasiswa Aktif' }}</li>
                                <li><span>{{ $siteSettings['about_stat_3_value'] ?? '6' }}</span> {{ $siteSettings['about_stat_3_label'] ?? 'Laboratorium' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-7">
                <div class="about-style4-img-box">
                    <div class="inner">
                        <img src="{{ $toUrl($siteSettings['about_image_path'] ?? 'assets/images/depan4.png') }}"
                            alt="{{ $siteSettings['about_image_alt'] ?? 'Tentang Program Magister Teknik Sipil UNMUL' }}">
                    </div>
                    <div class="shape-box1 bgclr1 wow slideInRight" data-wow-delay="100ms" data-wow-duration="3500ms"></div>
                </div>
            </div>
        </div>
    </div>
</section>
