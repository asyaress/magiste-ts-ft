@extends('layouts.app')

@section('title', 'Tentang Program Studi S2 Teknik Sipil - Universitas Mulawarman')

@section('content')
    {{-- BREADCRUMB --}}
    <section class="breadcrumb-area"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb-1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title">
                            <h2>Tentang Program Studi</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Beranda</a></li>
                                <li><span class="fa fa-angle-right"></span></li>
                                <li class="active">
                                    Tentang Program Studi
                                    <i class="flaticon-right-arrow-1 arrow1"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ABOUT PROGRAM STUDI --}}
    <section class="about-style2-area pdt120-pdb0 about-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="about-style2-content-box text-right-rtl">
                        <div class="text-holder">
                            <div class="sec-title">
                                <div class="sub-title">
                                    <h5>Program Studi</h5>
                                </div>
                                <h2>
                                    Magister (S2) Teknik Sipil<br>
                                    <span>Universitas Mulawarman</span>
                                </h2>
                            </div>

                            <div class="inner-content">
                                <h3>
                                    Program magister yang berfokus pada rekayasa teknik sipil berbasis
                                    keberlanjutan di wilayah hutan tropis lembab dan pembangunan yang berwawasan
                                    lingkungan.
                                </h3>

                                <p>
                                    Program Studi Magister (S2) Teknik Sipil Universitas Mulawarman bertujuan
                                    menghasilkan lulusan yang <strong>berintegritas, inovatif, adaptif, dan
                                        profesional</strong>, dengan kemampuan mengembangkan rekayasa teknik sipil
                                    berbasis <strong>keberlanjutan</strong> untuk mendukung pengelolaan hutan
                                    tropis lembab dan pembangunan infrastruktur di kawasan Kalimantan, termasuk
                                    keterlibatan langsung pada proyek strategis nasional seperti
                                    <strong>Ibu Kota Negara (IKN)</strong>.
                                </p>

                                <p>
                                    Kurikulum dirancang secara khusus untuk menjawab kebutuhan pembangunan
                                    berkelanjutan di wilayah tropis dan pedalaman, dengan capaian pembelajaran
                                    yang berorientasi pada <strong>teknologi terkini, keberlanjutan, dan
                                        inovasi</strong> di bidang teknik sipil. Sistem perkuliahan dilaksanakan
                                    secara <strong>hybrid (luring &amp; daring)</strong> dengan jadwal kuliah
                                    pada hari <strong>Jumat dan Sabtu</strong> sehingga tetap fleksibel bagi
                                    mahasiswa yang telah bekerja.
                                </p>

                                <ul class="bgclr1">
                                    <li><span>54</span> Total SKS Program Studi.</li>
                                    <li><span>3</span> Fokus riset utama: Struktur, Transportasi, Keairan &amp; Geoteknik.
                                    </li>
                                    <li><span>2</span> Hari perkuliahan: Jumat &amp; Sabtu (Hybrid).</li>
                                </ul>
                            </div>
                        </div>

                        <div class="img-box">
                            <div class="main_image">
                                <div class="inner wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                                    <img src="{{ asset('assets/images/about/about-style2-image-1.jpg') }}"
                                        alt="Kegiatan akademik Program Studi S2 Teknik Sipil">
                                </div>

                                <div class="image_2 wow slideInDown" data-wow-delay="400ms" data-wow-duration="1500ms">
                                    <img src="{{ asset('assets/images/about/about-style2-image-2.jpg') }}"
                                        alt="Suasana perkuliahan">
                                </div>

                                <div class="image_3 wow slideInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
                                    <img src="{{ asset('assets/images/about/about-style2-image-3.jpg') }}"
                                        alt="Kegiatan laboratorium dan penelitian">
                                </div>

                                <div class="image_4 wow slideInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                                    <img src="{{ asset('assets/images/about/about-style2-image-4.jpg') }}"
                                        alt="Kerja sama dan diskusi akademik">
                                </div>

                                <div class="image_5 wow slideInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                    <img src="{{ asset('assets/images/about/about-style2-image-5.jpg') }}"
                                        alt="Lingkungan kampus Universitas Mulawarman">
                                </div>
                            </div>
                        </div>
                    </div> {{-- /.about-style2-content-box --}}
                </div>
            </div>
        </div>
    </section>

    {{-- KEUNGGULAN PROGRAM --}}
    <section class="service-style1-area bg_white">
        <div class="container">
            <div class="row">
                {{-- Keunggulan 1 --}}
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="single-service-style1">
                        <div class="icon-holder">
                            <div class="inner">
                                <span class="flaticon-architect"></span>
                            </div>
                        </div>
                        <div class="text-holder">
                            <h3><a href="#">Keunggulan Geografis &amp;<br>Kontekstual</a></h3>
                            <p>
                                Berada di wilayah Kalimantan dengan fokus pada infrastruktur berkelanjutan
                                di kawasan tropis dan pedalaman, serta mendukung pengembangan Ibu Kota
                                Negara (IKN).
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Keunggulan 2 --}}
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="single-service-style1">
                        <div class="icon-holder">
                            <div class="inner">
                                <span class="flaticon-chemical"></span>
                            </div>
                        </div>
                        <div class="text-holder">
                            <h3><a href="#">Kurikulum Berbasis<br>Keberlanjutan &amp; Inovasi</a></h3>
                            <p>
                                Capaian pembelajaran berorientasi pada teknologi terkini, keberlanjutan,
                                dan inovasi yang relevan dengan kebutuhan pembangunan nasional dan
                                proyek strategis.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Keunggulan 3 --}}
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="single-service-style1">
                        <div class="icon-holder">
                            <div class="inner">
                                <span class="flaticon-garage-owner"></span>
                            </div>
                        </div>
                        <div class="text-holder">
                            <h3><a href="#">Keterlibatan Proyek<br>Strategis Nasional</a></h3>
                            <p>
                                Mahasiswa berpeluang terlibat dalam kajian dan pengembangan
                                infrastruktur yang berkaitan dengan proyek-proyek besar, termasuk IKN
                                dan pembangunan berkelanjutan di Kalimantan.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Keunggulan 4 --}}
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="single-service-style1">
                        <div class="icon-holder">
                            <div class="inner">
                                <span class="flaticon-car-parts"></span>
                            </div>
                        </div>
                        <div class="text-holder">
                            <h3><a href="#">Jaringan Mitra &amp;<br>Kerja Sama</a></h3>
                            <p>
                                Menjalin kerja sama strategis dengan lembaga pemerintah dan swasta
                                pada tingkat regional, nasional, maupun internasional untuk mendukung
                                Tri Dharma Perguruan Tinggi.
                            </p>
                        </div>
                    </div>
                </div>
            </div> {{-- /.row --}}
        </div>
    </section>

    {{-- PROFIL LULUSAN & FOKUS RISET --}}
    <section class="features-style2-area">
        <div class="container">
            <div class="row">
                {{-- Profil Lulusan & Fokus Riset --}}
                <div class="col-xl-6">
                    <div class="features-content-box">
                        <div class="title">
                            <h2>Profil Lulusan<br>&amp; Fokus Riset.</h2>
                        </div>

                        <p>
                            Lulusan Program Studi Magister (S2) Teknik Sipil Universitas Mulawarman disiapkan
                            untuk berperan sebagai pemimpin dan pengambil keputusan di bidang infrastruktur
                            yang berwawasan lingkungan dan berkelanjutan.
                        </p>

                        <h4>Profil Lulusan</h4>
                        <ul>
                            <li>
                                <span class="flaticon-architect clr1"></span>
                                Ahli Teknik Infrastruktur dan Konstruksi.
                            </li>
                            <li>
                                <span class="flaticon-chemical clr1"></span>
                                Peneliti &amp; Pengembang Teknologi Teknik Sipil.
                            </li>
                            <li>
                                <span class="flaticon-garage-owner clr1"></span>
                                Konsultan Teknik &amp; Manajemen Infrastruktur, serta
                                pemimpin dan inovator dalam pembangunan berkelanjutan.
                            </li>
                        </ul>

                        <h4 class="mgt20">Fokus Riset Utama</h4>
                        <p>
                            Kegiatan akademik dan penelitian di Program Studi S2 Teknik Sipil dikembangkan
                            dalam tiga fokus utama:
                        </p>

                        <ul>
                            <li>
                                <span class="flaticon-boxes clr1"></span>
                                <strong>Struktur</strong> – perilaku dan perencanaan struktur bangunan
                                dan infrastruktur.
                            </li>
                            <li>
                                <span class="flaticon-boxes clr1"></span>
                                <strong>Transportasi</strong> – rekayasa transportasi dan manajemen
                                lalu lintas untuk mendukung mobilitas yang efisien dan aman.
                            </li>
                            <li>
                                <span class="flaticon-boxes clr1"></span>
                                <strong>Keairan &amp; Geoteknik</strong> – pengelolaan sumber daya air,
                                fondasi, tanah, dan kestabilan lereng di wilayah tropis.
                            </li>
                        </ul>

                        <div class="button mgt20">
                            <a class="btn-one" href="#">
                                <span class="txt">
                                    Lihat Kurikulum
                                    <i class="flaticon-right-arrow-1 arrow1"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Gambar pendukung --}}
                <div class="col-xl-6">
                    <div class="features-style2-image-box">
                        <img src="{{ asset('assets/images/resources/features-2.jpg') }}"
                            alt="Ilustrasi kegiatan akademik dan riset teknik sipil">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- DOSEN & BIDANG KEILMUAN (4 DOSEN PERTAMA) --}}
    <!-- <section class="team-style1-area">
            <div class="container">
                <div class="sec-title text-center">
                    <div class="sub-title">
                        <p>Dosen dengan kompetensi pada berbagai bidang keilmuan teknik sipil.</p>
                    </div>
                    <h2>Dosen &amp; Bidang Keahlian</h2>
                </div>

                <div class="row text-right-rtl">
                    {{-- Dosen 1: Prof. Tamrin --}}
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="single-team-item">
                            <div class="img-holder">
                                <div class="inner">
                                    <img src="{{ asset('assets/images/team/team-v1-1.jpg') }}"
                                        alt="Foto Prof. Dr. Ir. H. Tamrin, S.T., M.T., IPU., ASEAN Eng., APEC Eng.">
                                </div>
                                <div class="overlay-icon">
                                    <a href="#"><span class="flaticon-plus"></span></a>
                                </div>
                                <div class="social-icon">
                                    <ul>
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fa fa-twitter-square"></i></a></li>
                                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#" class="pint"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" class="drib"><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="title-holder">
                                <h3>Prof. Dr. Ir. H. Tamrin, S.T., M.T., IPU., ASEAN Eng., APEC Eng.</h3>
                                <p>Bidang Keahlian: Keairan &amp; Geoteknik</p>
                            </div>
                        </div>
                    </div>

                    {{-- Dosen 2: Dr. Hj. Mardewi Jamal --}}
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInDown" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="single-team-item">
                            <div class="img-holder">
                                <div class="inner">
                                    <img src="{{ asset('assets/images/team/team-v1-2.jpg') }}"
                                        alt="Foto Dr. Ir. Hj. Mardewi Jamal, S.T., M.T., IPM.">
                                </div>
                                <div class="overlay-icon">
                                    <a href="#"><span class="flaticon-plus"></span></a>
                                </div>
                                <div class="social-icon">
                                    <ul>
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fa fa-twitter-square"></i></a></li>
                                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#" class="pint"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" class="drib"><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="title-holder">
                                <h3>Dr. Ir. Hj. Mardewi Jamal, S.T., M.T., IPM.</h3>
                                <p>Bidang Keahlian: Struktur</p>
                            </div>
                        </div>
                    </div>

                    {{-- Dosen 3: Dr. Ery Budiman --}}
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="single-team-item">
                            <div class="img-holder">
                                <div class="inner">
                                    <img src="{{ asset('assets/images/team/team-v1-3.jpg') }}"
                                        alt="Foto Dr. Ir. Ery Budiman, S.T., M.T., IPM.">
                                </div>
                                <div class="overlay-icon">
                                    <a href="#"><span class="flaticon-plus"></span></a>
                                </div>
                                <div class="social-icon">
                                    <ul>
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fa fa-twitter-square"></i></a></li>
                                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#" class="pint"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" class="drib"><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="title-holder">
                                <h3>Dr. Ir. Ery Budiman, S.T., M.T., IPM.</h3>
                                <p>Bidang Keahlian: Struktur</p>
                            </div>
                        </div>
                    </div>

                    {{-- Dosen 4: Dr. Tiopan Henry Manto Gultom --}}
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInDown" data-wow-delay="400ms" data-wow-duration="1500ms">
                        <div class="single-team-item">
                            <div class="img-holder">
                                <div class="inner">
                                    <img src="{{ asset('assets/images/team/team-v1-4.jpg') }}"
                                        alt="Foto Dr. Ir. Tiopan Henry Manto Gultom, S.T., M.T.">
                                </div>
                                <div class="overlay-icon">
                                    <a href="#"><span class="flaticon-plus"></span></a>
                                </div>
                                <div class="social-icon">
                                    <ul>
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fa fa-twitter-square"></i></a></li>
                                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#" class="pint"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" class="drib"><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="title-holder">
                                <h3>Dr. Ir. Tiopan Henry Manto Gultom, S.T., M.T.</h3>
                                <p>Bidang Keahlian: Transportasi</p>
                            </div>
                        </div>
                    </div>
                </div> {{-- /.row --}}
            </div>
        </section> -->
@endsection
