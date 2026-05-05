<!--Start Header-->
<div class="header-bottom header-bottom-style4">
    <div class="container">
        <div class="outer-box clearfix">

            <div class="header-bottom_left pull-left">
                <div class="nav-outer style1 clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <div class="inner">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </div>
                    </div>
                    <!-- Main Menu -->
                    <nav class="main-menu style1 navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="{{ request()->routeIs('dashboard') ? 'current' : '' }}">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>

                                <li
                                    class="dropdown {{ request()->routeIs('about.index', 'teams.index', 'struktur.index', 'akreditasi.index') ? 'current' : '' }}">
                                    <a href="#">Profil</a>
                                    <ul>
                                        <li><a href="{{ route('about.index') }}">Tentang Program</a></li>
                                        <li><a href="{{ route('dashboard') }}#visi-misi">Visi & Misi</a></li>
                                        <li><a href="{{ route('teams.index') }}">Dosen & Tenaga Kependidikan</a></li>
                                        <li><a href="{{ route('struktur.index') }}">Struktur Organisasi</a></li>
                                        <li><a href="{{ route('akreditasi.index') }}">Akreditasi</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown {{ request()->routeIs('kurikulum.index', 'kalender.index', 'jadwal.index') ? 'current' : '' }}">
                                    <a href="#">Akademik</a>
                                    <ul>
                                        <li><a href="{{ route('kurikulum.index') }}">Kurikulum</a></li>
                                        <li><a href="{{ route('kalender.index') }}">Kalender Akademik</a></li>
                                        <li><a href="{{ route('jadwal.index') }}">Mata Kuliah</a></li>
                                    </ul>
                                </li>

                                <li class="{{ request()->routeIs('penelitiandanpengabdian.index') ? 'current' : '' }}">
                                    <a href="{{ route('penelitiandanpengabdian.index') }}">Penelitian & Pengabdian</a>
                                </li>

                                <li class="{{ request()->routeIs('kerjasama.index') ? 'current' : '' }}">
                                    <a href="{{ route('kerjasama.index') }}">Kerja Sama</a>
                                </li>

                                <li class="dropdown {{ request()->routeIs('jurnal.index', 'buku.index', 'hki.index') ? 'current' : '' }}">
                                    <a href="#">Publikasi</a>
                                    <ul>
                                        <li><a href="{{ route('jurnal.index') }}">Jurnal</a></li>
                                        <li><a href="{{ route('buku.index') }}">Buku</a></li>
                                        <li><a href="{{ route('hki.index') }}">HKI</a></li>
                                    </ul>
                                </li>

                                <li class="{{ request()->routeIs('blog.index', 'blog.show') ? 'current' : '' }}">
                                    <a href="{{ route('blog.index') }}">Berita</a>
                                </li>
                            </ul>

                        </div>
                    </nav>

                    <!-- Main Menu End-->
                </div>
            </div>

            <div class="header-bottom_right pull-right">
                <div class="header-bottom_right__btn_style2 style2instyle3">
                    <a href="#"><span class="flaticon-right-arrow-1 right-arrow"></span></a>
                </div>
            </div>

        </div>
    </div>
</div>
<!--End header-->
