<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel | Magister Teknik Sipil UNMUL')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <style>
        :root {
            --admin-brand: #ff6600;
            --admin-brand-dark: #d95300;
            --admin-sidebar: #1f2430;
            --admin-sidebar-soft: #2a3142;
            --admin-bg: #f4f6fb;
            --admin-text: #2c3440;
        }

        body {
            font-family: "Plus Jakarta Sans", sans-serif;
            background: var(--admin-bg);
            color: var(--admin-text);
        }

        .content-wrapper {
            background: linear-gradient(180deg, #f8f9fc 0%, #f2f4f8 100%);
        }

        .main-header.navbar {
            border-bottom: 1px solid #e8ebf0;
            box-shadow: 0 8px 24px rgba(20, 28, 45, 0.05);
        }

        .main-sidebar {
            background: linear-gradient(180deg, var(--admin-sidebar) 0%, #181d27 100%);
        }

        .brand-link {
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .brand-link .brand-text {
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .sidebar .form-control-sidebar {
            border-radius: 10px;
        }

        .nav-sidebar .nav-header {
            color: #8f99aa;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: 10px;
        }

        .nav-sidebar .nav-link {
            border-radius: 10px;
            margin: 2px 8px;
            transition: all .2s ease;
        }

        .nav-sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .nav-sidebar .nav-link.active {
            background: linear-gradient(90deg, var(--admin-brand) 0%, #ff8d3a 100%);
            color: #fff;
            box-shadow: 0 8px 20px rgba(255, 102, 0, 0.25);
        }

        .nav-sidebar .menu-open>.nav-link {
            background-color: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .content-header h1,
        .content-header .m-0 {
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .card {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(16, 24, 40, 0.06);
        }

        .card-header {
            border-bottom: 1px solid #eff2f7;
        }

        .btn-primary {
            background: linear-gradient(90deg, #ff6a00 0%, #ff8b38 100%);
            border-color: #ff6a00;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #eb6200 0%, #ff7d24 100%);
            border-color: #eb6200;
        }

        .table thead th {
            border-top: 0;
            border-bottom: 1px solid #edf0f5;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #6c7a91;
        }

        .table td {
            vertical-align: middle;
        }

        .badge-soft {
            background: #fff3ec;
            color: #a34a17;
            border: 1px solid #ffd8c4;
        }

        .modal-backdrop.show {
            opacity: 0.55;
            background-color: #2b2f33;
        }

        .modal .modal-content {
            background: rgba(255, 255, 255, 0.82);
            border: 1px solid rgba(255, 255, 255, 0.45);
            border-radius: 12px;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.28);
        }

        .modal .modal-header,
        .modal .modal-footer {
            border-color: rgba(255, 255, 255, 0.45);
        }

        .modal .form-control,
        .modal .custom-select,
        .modal .form-control-file {
            background-color: rgba(255, 255, 255, 0.92);
        }

        .note-editor.note-frame {
            border-color: #e4e9f2;
            border-radius: 10px;
        }

        .main-footer {
            background: #fff;
            border-top: 1px solid #e8ebf0;
            font-size: 13px;
            color: #64748b;
        }
    </style>
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
    @php
        $homeOpen = request()->routeIs('admin.home-hero-slides.*') || request()->routeIs('admin.home-mission-items.*') || request()->routeIs('admin.home-faq-items.*');
        $academicOpen = request()->routeIs('admin.research-topics.*')
            || request()->routeIs('admin.research-sections.*')
            || request()->routeIs('admin.video-items.*')
            || request()->routeIs('admin.video-sections.*')
            || request()->routeIs('admin.gallery-items.*')
            || request()->routeIs('admin.gallery-sections.*')
            || request()->routeIs('admin.teachers.*')
            || request()->routeIs('admin.teacher-sections.*')
            || request()->routeIs('admin.blog-posts.*')
            || request()->routeIs('admin.blog-sections.*');
    @endphp

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin Dashboard</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-md-inline-block">
                    <a href="{{ url('/') }}" target="_blank" rel="noopener" class="nav-link">
                        <i class="fas fa-globe-asia mr-1"></i> Lihat Website
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-user-circle mr-1"></i> {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">{{ auth()->user()->email }}</span>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <img src="{{ asset('assets/images/logots.jpg') }}" alt="Logo TSFT" class="brand-image img-circle elevation-2"
                    style="opacity: .95">
                <span class="brand-text font-weight-light">Admin TSFT</span>
            </a>

            <div class="sidebar">
                <div class="form-inline mt-2">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Cari menu..."
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mt-2 pb-4">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-header">Main</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-header">Home Content</li>
                        <li class="nav-item {{ $homeOpen ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $homeOpen ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Beranda <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.home-hero-slides.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.home-hero-slides.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Hero Slides</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.home-mission-items.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.home-mission-items.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Visi & Misi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.home-faq-items.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.home-faq-items.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>FAQ Pendaftaran</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">Akademik & Publikasi</li>
                        <li class="nav-item {{ $academicOpen ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $academicOpen ? 'active' : '' }}">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Konten Utama <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.research-topics.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.research-topics.*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Research Topics</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.research-sections.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.research-sections.*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Research Sections</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.video-items.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.video-items.*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Video Items</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.video-sections.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.video-sections.*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Video Sections</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.gallery-items.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.gallery-items.*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Gallery Items</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.gallery-sections.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.gallery-sections.*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Gallery Sections</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.teachers.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Teachers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.teacher-sections.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.teacher-sections.*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Teacher Sections</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.blog-posts.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.blog-posts.*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Berita & Artikel</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.blog-sections.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.blog-sections.*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Blog Sections</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">Pengaturan</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.site-settings.index') }}"
                                class="nav-link {{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Site Settings</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        @yield('content')

        <footer class="main-footer">
            <strong>&copy; {{ now()->year }} <a href="{{ route('admin.dashboard') }}">Admin TSFT</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <span class="badge badge-soft">Pro Admin UI</span>
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>

    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button);

        $(function() {
            const collapsed = localStorage.getItem('admin_sidebar_collapsed') === '1';
            if (collapsed) {
                $('body').addClass('sidebar-collapse');
            }

            $(document).on('collapsed.lte.pushmenu', function() {
                localStorage.setItem('admin_sidebar_collapsed', '1');
            });

            $(document).on('shown.lte.pushmenu', function() {
                localStorage.setItem('admin_sidebar_collapsed', '0');
            });

            if ($.fn.selectpicker) {
                $('.selectpicker').selectpicker();
            }

            if ($.fn.select2) {
                $('.select2').select2({
                    theme: 'bootstrap4'
                });
            }

            if ($('#example1').length) {
                $("#example1").DataTable({
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    pageLength: 25,
                    order: [],
                    buttons: ["copy", "excel", "pdf", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            }

            if ($('#example11').length) {
                $("#example11").DataTable({
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
                    searching: false,
                    paging: false,
                    info: false
                });
            }

            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 3500);
        });
    </script>
    @stack('scripts')
</body>

</html>

