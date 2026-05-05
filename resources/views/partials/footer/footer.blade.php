<!--Start footer area -->
<footer class="footer-area">
    <!--Start Footer-->
    <div class="footer">
        <div class="container">
            <div class="row text-right-rtl">

                <!-- 1) Logo & Tentang Prodi -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="single-footer-widget marbtm wow animated fadeInUp" data-wow-delay="0.1s">
                        <div class="our-company-info">
                            <div class="footer-logo">
                                <a href="{{ url('/') }}">
<img
  src="{{ asset('assets/images/logots.jpg') }}"
  alt="Logo S2 Teknik Sipil UNMUL"
  title="S2 Teknik Sipil UNMUL"
  style="width:85px;height:85px;object-fit:contain;"
/>
                                </a>
                            </div>
                            <div class="text-box">
                                <p>{!! nl2br(e($siteSettings['footer_about_text'] ?? 'Program Studi Magister (S2) Teknik Sipil Universitas Mulawarman.')) !!}</p>
                            </div>
                            <div class="footer-social-links">
                                <ul class="social-links-style1">
                                    <li><a href="{{ $facebook ?? '#' }}" aria-label="Facebook"><i class="fa fa-facebook"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="{{ $twitter ?? '#' }}" aria-label="Twitter"><i class="fa fa-twitter"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="{{ $linkedin ?? '#' }}" aria-label="LinkedIn"><i class="fa fa-linkedin"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href="{{ $instagram ?? '#' }}" aria-label="Instagram"><i
                                                class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2) Profil -->
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 wow animated fadeInUp" data-wow-delay="0.3s">
                    <div class="single-footer-widget martop marbtm">
                        <div class="title">
                            <h3>Profil</h3>
                        </div>
                        <ul class="footer-widget-links1">
                            <li><a href="#visi-misi"><i class="fa fa-angle-right"></i>Visi & Misi</a></li>
                            <li><a href="#fokus-riset"><i class="fa fa-angle-right"></i>Fokus Riset</a></li>
                            <li><a href="#kurikulum"><i class="fa fa-angle-right"></i>Kurikulum (54 SKS)</a></li>
                            <li><a href="#dosen"><i class="fa fa-angle-right"></i>Tim Dosen</a></li>
                        </ul>
                    </div>
                </div>

                <!-- 3) Pendaftaran -->
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 wow animated fadeInUp" data-wow-delay="0.5s">
                    <div class="single-footer-widget martop marbtm">
                        <div class="title">
                            <h3>Pendaftaran</h3>
                        </div>
                        <ul class="footer-widget-links1">
                            <li><a href="https://pmb.unmul.ac.id/" target="_blank" rel="noopener">Portal PMB UNMUL</a>
                            </li>
                            <li><a href="https://tiny.cc/form_MS2TS/" target="_blank" rel="noopener">Formulir
                                    Pendaftaran Magister</a></li>
                            <li><a href="#alur-pendaftaran-s2-sipil">Alur Pendaftaran</a></li>
                            <li><a href="#biaya">Biaya UKT & Pendaftaran</a></li>
                        </ul>
                    </div>
                </div>

                <!-- 4) Akademik -->
                <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12 wow animated fadeInUp" data-wow-delay="0.7s">
                    <div class="single-footer-widget martop">
                        <div class="title">
                            <h3>Akademik</h3>
                        </div>
                        <ul class="footer-widget-links1">
                            <li><a href="#sistem-perkuliahan">Sistem Perkuliahan (Hybrid)</a></li>
                            <li><a href="#jadwal">Hari Kuliah: Jumat & Sabtu</a></li>
                            <li><a href="#lokasi">Ruang Perkuliahan</a></li>
                            <li><a href="#layanan">Layanan Akademik</a></li>
                        </ul>
                    </div>
                </div>

                <!-- 5) Kontak & Alamat -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 wow animated fadeInUp" data-wow-delay="0.8s">
                    <div class="single-footer-widget martop pdtop">
                        <div class="title">
                            <h3>{{ $siteSettings['footer_contact_title'] ?? 'Kontak & Lokasi' }}</h3>
                        </div>
                        <div class="mb-2">{!! $siteSettings['footer_contact_address_html'] ?? '<address class="mb-2"><strong>Fakultas Teknik UNMUL</strong><br>Gedung Fakultas Teknik, Jl. Sambaliung No.9<br>Kampus Gunung Kelua, Kota Samarinda</address>' !!}</div>
                        <p class="mb-1">
                            WA: {{ $kontak_wa ?? '08xx-xxxx-xxxx' }}<br>
                            Email: {{ $email_prodi ?? 'email@unmul.ac.id' }}
                        </p>
                        <small class="text-muted d-block">{!! nl2br(e($siteSettings['footer_contact_note'] ?? 'Sistem kuliah: 16x pertemuan (14 materi, 2 UTS/UAS), metode luring & daring (maks. 50% daring).')) !!}</small>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--End Footer-->
</footer>
<!--End footer area -->
