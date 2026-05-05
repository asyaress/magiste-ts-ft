@php
    $toUrl = function (?string $path): ?string {
        if (!$path) {
            return null;
        }
        return \Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '/']) ? $path : asset($path);
    };

    $faqItems = ($faqItems ?? collect())->values();

    if ($faqItems->isEmpty()) {
        $faqItems = collect([
            (object) [
                'step_number' => 1,
                'title' => 'Cek persyaratan & biaya',
                'content_html' => '<p>Silakan lengkapi persyaratan pendaftaran sesuai ketentuan PMB terbaru.</p>',
                'is_open_by_default' => true,
            ],
        ]);
    }

    $contactUrl = $siteSettings['contact_link_url'] ?? '#';
@endphp

<section class="faq-style1-area" id="alur-pendaftaran-s2-sipil">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="faq-style1-image-box">
                    <div class="inner clearfix">
                        <img src="{{ $toUrl($siteSettings['faq_image_path'] ?? 'assets/images/depan5.jpg') }}"
                            alt="{{ $siteSettings['faq_image_alt'] ?? 'Alur Pendaftaran S2 Teknik Sipil Universitas Mulawarman' }}">
                    </div>
                </div>
            </div>

            <div class="col-xl-6 text-right-rtl">
                <div class="faq-style1-content">
                    <div class="sec-title">
                        <div class="sub-title"><h5>{{ $siteSettings['faq_section_subtitle'] ?? 'Alur Pendaftaran & Ketentuan' }}</h5></div>
                        <h2>{{ $siteSettings['faq_section_title_line1'] ?? 'Langkah-langkah Pendaftaran' }}<br><span>{{ $siteSettings['faq_section_title_line2'] ?? '- S2 Teknik Sipil UNMUL' }}</span></h2>
                    </div>

                    <div class="accordion-box">
                        @foreach($faqItems as $faq)
                            @php
                                $isOpen = !empty($faq->is_open_by_default) || $loop->first;
                            @endphp
                            <div class="accordion accordion-block">
                                <div class="accord-btn {{ $isOpen ? 'active' : '' }}">
                                    <h4><span>{{ str_pad((string) $faq->step_number, 2, '0', STR_PAD_LEFT) }}</span> {{ $faq->title }}</h4>
                                </div>
                                <div class="accord-content {{ $isOpen ? 'collapsed' : '' }}">
                                    {!! $faq->content_html !!}
                                </div>
                            </div>
                        @endforeach

                        <div class="accordion accordion-block">
                            <div class="accord-btn">
                                <h4><span>{{ str_pad((string) ($faqItems->count() + 1), 2, '0', STR_PAD_LEFT) }}</span> Kontak admin prodi</h4>
                            </div>
                            <div class="accord-content">
                                <p class="mb-1">
                                    WA: {{ $kontak_wa ?? '08xx-xxxx-xxxx' }} &nbsp;|&nbsp;
                                    Email: {{ $email_prodi ?? 'email@unmul.ac.id' }}
                                </p>
                                <p class="mb-0">Halaman kontak: <a href="{{ $contactUrl }}">Hubungi Kami</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
