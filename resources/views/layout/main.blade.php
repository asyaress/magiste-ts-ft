<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel | Magister Teknik Sipil UNMUL')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

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
        /* ─── Design Tokens ─────────────────────────── */
        :root {
            --brand:        #f97316;
            --brand-light:  #fff7ed;
            --brand-dark:   #ea580c;
            --sidebar-w:    260px;
            --sidebar-bg:   #ffffff;
            --sidebar-border: #e8ecf0;
            --body-bg:      #f1f5f9;
            --text:         #0f172a;
            --text-muted:   #64748b;
            --border:       #e2e8f0;
            --card-shadow:  0 1px 4px rgba(15,23,42,.06);
        }

        /* ─── Base ──────────────────────────────────── */
        body {
            font-family: 'Inter', sans-serif;
            background: var(--body-bg);
            color: var(--text);
            font-size: 13.5px;
        }

        /* ─── Sidebar ───────────────────────────────── */
        .main-sidebar,
        .sidebar {
            background: var(--sidebar-bg) !important;
        }

        .main-sidebar {
            border-right: 1px solid var(--sidebar-border) !important;
            box-shadow: none !important;
        }

        /* Brand / logo area */
        .brand-link {
            background: var(--sidebar-bg) !important;
            border-bottom: 1px solid var(--sidebar-border) !important;
            padding: 14px 16px !important;
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
        }

        .brand-link:hover { background: #f9fafb !important; }

        .brand-link .brand-image {
            width: 32px !important;
            height: 32px !important;
            object-fit: cover;
            border-radius: 8px;
            margin: 0 !important;
            box-shadow: none !important;
        }

        .brand-link .brand-text {
            color: var(--text) !important;
            font-weight: 700 !important;
            font-size: 14px !important;
            letter-spacing: -0.2px;
        }

        /* Nav section headers */
        .nav-sidebar .nav-header {
            color: #94a3b8 !important;
            font-size: 10px !important;
            font-weight: 700 !important;
            letter-spacing: 0.1em !important;
            text-transform: uppercase !important;
            padding: 16px 16px 5px !important;
            margin-top: 0 !important;
        }

        /* Nav links */
        .nav-sidebar .nav-link {
            color: #6b7280 !important;
            font-size: 13.5px !important;
            font-weight: 500 !important;
            border-radius: 8px !important;
            margin: 1px 8px !important;
            padding: 8px 12px !important;
            transition: background 0.12s, color 0.12s !important;
            display: flex !important;
            align-items: center !important;
        }

        .nav-sidebar .nav-link:hover {
            background: #f8fafc !important;
            color: var(--text) !important;
        }

        /* Active state */
        .sidebar-light-primary .nav-sidebar .nav-link.active,
        .sidebar-light-primary .nav-sidebar .nav-link.active:hover,
        .nav-sidebar .nav-link.active,
        .nav-sidebar .nav-link.active:hover {
            background: var(--brand-light) !important;
            color: var(--brand-dark) !important;
            font-weight: 600 !important;
            box-shadow: none !important;
        }

        /* Parent open state */
        .nav-sidebar .menu-open > .nav-link {
            background: #f8fafc !important;
            color: var(--text) !important;
        }

        /* Icons */
        .nav-sidebar .nav-icon {
            font-size: 14px !important;
            width: 18px !important;
            margin-right: 8px !important;
            text-align: center !important;
            color: inherit !important;
        }

        /* Treeview sub-items */
        .nav-treeview .nav-link {
            padding: 7px 12px 7px 38px !important;
            font-size: 13px !important;
        }

        /* Treeview angle arrow */
        .nav-sidebar .nav-link .right {
            color: #cbd5e1 !important;
            font-size: 11px !important;
        }

        /* ─── Top Navbar ─────────────────────────────── */
        .main-header.navbar {
            background: #ffffff !important;
            border-bottom: 1px solid var(--border) !important;
            box-shadow: none !important;
            min-height: 56px !important;
        }

        .main-header .nav-link {
            color: var(--text-muted) !important;
            font-size: 13.5px !important;
            font-weight: 500 !important;
        }

        .main-header .nav-link:hover { color: var(--text) !important; }

        /* Hamburger icon */
        .main-header .nav-link [data-widget="pushmenu"],
        .main-header [data-widget="pushmenu"] {
            color: var(--text) !important;
        }

        /* User dropdown */
        .main-header .dropdown-menu {
            border: 1px solid var(--border) !important;
            border-radius: 12px !important;
            box-shadow: 0 8px 32px rgba(0,0,0,.1) !important;
            padding: 6px !important;
            margin-top: 8px !important;
        }

        .main-header .dropdown-item {
            border-radius: 8px !important;
            font-size: 13.5px !important;
            padding: 8px 12px !important;
            color: var(--text) !important;
        }

        .main-header .dropdown-item:hover {
            background: #f8fafc !important;
        }

        .main-header .dropdown-item.text-danger { color: #dc2626 !important; }
        .main-header .dropdown-item.text-danger:hover { background: #fef2f2 !important; }

        .main-header .dropdown-header {
            font-size: 12px !important;
            color: var(--text-muted) !important;
            padding: 6px 12px !important;
        }

        .main-header .dropdown-divider {
            border-color: var(--border) !important;
            margin: 4px 0 !important;
        }

        /* User avatar pill */
        .user-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 5px 12px 5px 6px;
            border-radius: 20px;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: border-color 0.15s, background 0.15s;
        }

        .user-pill:hover { border-color: #cbd5e1; background: #f8fafc; }

        .user-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--brand) 0%, #fb923c 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .user-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--text);
        }

        /* ─── Content Area ───────────────────────────── */
        .content-wrapper {
            background: var(--body-bg) !important;
        }

        .content-header h1 {
            font-size: 20px !important;
            font-weight: 700 !important;
            color: var(--text) !important;
            letter-spacing: -0.3px !important;
        }

        /* Page subtitle */
        .page-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* Breadcrumb */
        .breadcrumb {
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
            font-size: 12px !important;
        }

        .breadcrumb-item + .breadcrumb-item::before { color: #cbd5e1 !important; }

        /* ─── Cards ──────────────────────────────────── */
        .card {
            border: 1px solid var(--border) !important;
            border-radius: 12px !important;
            box-shadow: var(--card-shadow) !important;
            background: #ffffff !important;
        }

        .card-header {
            background: transparent !important;
            border-bottom: 1px solid var(--border) !important;
            padding: 14px 18px !important;
            border-radius: 12px 12px 0 0 !important;
        }

        .card-title {
            font-size: 14px !important;
            font-weight: 600 !important;
            color: var(--text) !important;
            margin: 0 !important;
        }

        .card-body { padding: 18px !important; }

        /* ─── Stat Cards ─────────────────────────────── */
        .stat-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            text-decoration: none;
            transition: border-color 0.15s, box-shadow 0.15s, transform 0.15s;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            border-color: var(--brand);
            box-shadow: 0 4px 20px rgba(249,115,22,.1);
            transform: translateY(-1px);
            text-decoration: none;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .stat-icon-orange { background: #fff7ed; color: #ea580c; }
        .stat-icon-blue   { background: #eff6ff; color: #2563eb; }
        .stat-icon-green  { background: #f0fdf4; color: #16a34a; }
        .stat-icon-purple { background: #faf5ff; color: #9333ea; }
        .stat-icon-rose   { background: #fff1f2; color: #e11d48; }
        .stat-icon-teal   { background: #f0fdfa; color: #0d9488; }
        .stat-icon-amber  { background: #fffbeb; color: #d97706; }
        .stat-icon-indigo { background: #eef2ff; color: #4f46e5; }

        .stat-content { flex: 1; min-width: 0; }

        .stat-value {
            font-size: 26px;
            font-weight: 700;
            color: var(--text);
            line-height: 1;
            letter-spacing: -0.5px;
        }

        .stat-label {
            font-size: 12.5px;
            color: var(--text-muted);
            margin-top: 4px;
            font-weight: 500;
        }

        .stat-link {
            font-size: 11.5px;
            color: var(--brand);
            font-weight: 600;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ─── Tables ─────────────────────────────────── */
        .table thead th {
            border-top: 0 !important;
            border-bottom: 1px solid var(--border) !important;
            font-size: 11px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.06em !important;
            color: var(--text-muted) !important;
            font-weight: 600 !important;
            padding: 10px 12px !important;
            background: #f8fafc !important;
        }

        .table td {
            vertical-align: middle !important;
            padding: 10px 12px !important;
            border-color: var(--border) !important;
            font-size: 13.5px !important;
            color: var(--text) !important;
        }

        .table-hover tbody tr:hover { background: #f8fafc !important; }

        /* ─── Buttons ────────────────────────────────── */
        .btn {
            font-family: 'Inter', sans-serif !important;
            font-weight: 500 !important;
            border-radius: 8px !important;
            font-size: 13px !important;
            padding: 7px 14px !important;
            transition: all 0.15s !important;
        }

        .btn-primary {
            background: var(--brand) !important;
            border-color: var(--brand) !important;
            color: #fff !important;
        }

        .btn-primary:hover {
            background: var(--brand-dark) !important;
            border-color: var(--brand-dark) !important;
        }

        .btn-outline-primary {
            border-color: var(--border) !important;
            color: var(--text) !important;
            background: #fff !important;
        }

        .btn-outline-primary:hover {
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: var(--text) !important;
        }

        .btn-sm {
            font-size: 12px !important;
            padding: 5px 10px !important;
        }

        .btn-danger { border-radius: 8px !important; }

        /* ─── Badges ─────────────────────────────────── */
        .badge {
            font-size: 11px !important;
            font-weight: 600 !important;
            border-radius: 6px !important;
            padding: 3px 8px !important;
        }

        .badge-success, .badge.bg-success {
            background: #dcfce7 !important;
            color: #15803d !important;
        }

        .badge-secondary, .badge.bg-secondary {
            background: #f1f5f9 !important;
            color: #64748b !important;
        }

        .badge-warning, .badge.bg-warning {
            background: #fef9c3 !important;
            color: #854d0e !important;
        }

        .badge-danger, .badge.bg-danger {
            background: #fee2e2 !important;
            color: #991b1b !important;
        }

        /* ─── Forms ──────────────────────────────────── */
        .form-control, .custom-select {
            border-color: var(--border) !important;
            border-radius: 8px !important;
            font-family: 'Inter', sans-serif !important;
            font-size: 13.5px !important;
            color: var(--text) !important;
            transition: border-color 0.15s, box-shadow 0.15s !important;
        }

        .form-control:focus, .custom-select:focus {
            border-color: var(--brand) !important;
            box-shadow: 0 0 0 3px rgba(249,115,22,.12) !important;
        }

        label {
            font-size: 13px !important;
            font-weight: 500 !important;
            color: #374151 !important;
        }

        /* ─── Modals ─────────────────────────────────── */
        .modal-backdrop.show { opacity: 0.4 !important; background: #0f172a !important; }

        .modal-content,
        .modal .modal-content,
        .modal-header,
        .modal .modal-header,
        .modal-body,
        .modal .modal-body,
        .modal-footer,
        .modal .modal-footer {
            background-color: #ffffff !important;
        }

        .modal-content,
        .modal .modal-content {
            border: 1px solid var(--border) !important;
            border-radius: 16px !important;
            box-shadow: 0 20px 60px rgba(0,0,0,.15) !important;
        }

        .modal-header,
        .modal .modal-header {
            padding: 20px 24px !important;
            border-bottom: 1px solid var(--border) !important;
            border-radius: 16px 16px 0 0 !important;
        }

        .modal-title {
            font-size: 16px !important;
            font-weight: 600 !important;
            color: var(--text) !important;
        }

        .modal-body,
        .modal .modal-body { padding: 20px 24px !important; }

        .modal-footer,
        .modal .modal-footer {
            padding: 16px 24px !important;
            border-top: 1px solid var(--border) !important;
            border-radius: 0 0 16px 16px !important;
        }

        /* ─── Alerts ─────────────────────────────────── */
        .alert {
            border-radius: 10px !important;
            font-size: 13.5px !important;
            border-width: 1px !important;
            padding: 12px 16px !important;
        }

        .alert-success {
            background: #f0fdf4 !important;
            border-color: #bbf7d0 !important;
            color: #15803d !important;
        }

        .alert-danger {
            background: #fef2f2 !important;
            border-color: #fecaca !important;
            color: #dc2626 !important;
        }

        .alert-warning {
            background: #fffbeb !important;
            border-color: #fde68a !important;
            color: #92400e !important;
        }

        /* ─── Summernote ─────────────────────────────── */
        .note-editor.note-frame {
            border-color: var(--border) !important;
            border-radius: 10px !important;
        }

        /* ─── DataTables overrides ───────────────────── */
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 5px 10px;
            font-size: 13px;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--brand);
            outline: none;
            box-shadow: 0 0 0 3px rgba(249,115,22,.1);
        }

        .page-item.active .page-link {
            background: var(--brand) !important;
            border-color: var(--brand) !important;
        }

        .page-link {
            color: var(--text) !important;
            border-color: var(--border) !important;
            border-radius: 6px !important;
            margin: 0 2px !important;
        }

        /* ─── Footer ─────────────────────────────────── */
        .main-footer {
            background: #ffffff !important;
            border-top: 1px solid var(--border) !important;
            font-size: 12.5px !important;
            color: var(--text-muted) !important;
            padding: 12px 24px !important;
        }

        /* ─── Sidebar collapsed icon mode ───────────── */
        body.sidebar-mini.sidebar-collapse .brand-link {
            padding: 14px 8px !important;
        }

        /* ─── Quick fix for admin-lte overflows ─────── */
        .content-header .row { margin-bottom: 0; }
    </style>
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
    @php
        $homeOpen     = request()->routeIs('admin.home-hero-slides.*') || request()->routeIs('admin.home-mission-items.*') || request()->routeIs('admin.home-faq-items.*');
        $academicOpen = request()->routeIs('admin.research-topics.*')  || request()->routeIs('admin.research-sections.*')
                     || request()->routeIs('admin.video-items.*')      || request()->routeIs('admin.video-sections.*')
                     || request()->routeIs('admin.gallery-items.*')    || request()->routeIs('admin.gallery-sections.*')
                     || request()->routeIs('admin.teachers.*')         || request()->routeIs('admin.teacher-sections.*')
                     || request()->routeIs('admin.blog-posts.*')       || request()->routeIs('admin.blog-sections.*');
    @endphp

    <div class="wrapper">

        {{-- ── Top Navbar ────────────────────────────── --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars" style="font-size:15px;color:#64748b;"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto" style="gap:4px;">
                <li class="nav-item d-none d-md-inline-block">
                    <a href="{{ url('/') }}" target="_blank" rel="noopener" class="nav-link"
                       style="font-size:13px;color:#64748b;display:flex;align-items:center;gap:6px;">
                        <i class="fas fa-external-link-alt" style="font-size:11px;"></i> Lihat Website
                    </a>
                </li>

                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link p-0 mr-2" data-toggle="dropdown" href="#" style="display:flex;align-items:center;">
                        <div class="user-pill">
                            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                            <span class="user-name d-none d-sm-inline">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down" style="font-size:10px;color:#94a3b8;margin-left:2px;"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <span class="dropdown-header">{{ auth()->user()->email }}</span>
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

        {{-- ── Sidebar ────────────────────────────────── --}}
        <aside class="main-sidebar sidebar-light-primary elevation-0">
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <img src="{{ asset('assets/images/logots.jpg') }}"
                     alt="Logo TSFT" class="brand-image">
                <span class="brand-text">Admin TSFT</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2 pb-4">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent"
                        data-widget="treeview" role="menu" data-accordion="false">

                        {{-- Dashboard --}}
                        <li class="nav-header">Main</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-large"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        {{-- Home Content --}}
                        <li class="nav-header">Halaman Beranda</li>
                        <li class="nav-item {{ $homeOpen ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $homeOpen ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Beranda <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.home-hero-slides.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.home-hero-slides.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-images"></i>
                                        <p>Hero Slides</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.home-mission-items.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.home-mission-items.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-bullseye"></i>
                                        <p>Visi &amp; Misi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.home-faq-items.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.home-faq-items.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-question-circle"></i>
                                        <p>FAQ Pendaftaran</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Akademik & Publikasi --}}
                        <li class="nav-header">Akademik &amp; Publikasi</li>
                        <li class="nav-item {{ $academicOpen ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $academicOpen ? 'active' : '' }}">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Konten Utama <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.research-topics.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.research-topics.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-flask"></i>
                                        <p>Research Topics</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.research-sections.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.research-sections.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-sitemap"></i>
                                        <p>Research Sections</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.video-items.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.video-items.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-video"></i>
                                        <p>Video Items</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.video-sections.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.video-sections.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-film"></i>
                                        <p>Video Sections</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.gallery-items.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.gallery-items.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-image"></i>
                                        <p>Gallery Items</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.gallery-sections.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.gallery-sections.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>Gallery Sections</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.teachers.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-user-tie"></i>
                                        <p>Dosen &amp; Staf</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.teacher-sections.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.teacher-sections.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>Teacher Sections</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.blog-posts.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.blog-posts.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-newspaper"></i>
                                        <p>Berita &amp; Artikel</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.blog-sections.index') }}"
                                       class="nav-link {{ request()->routeIs('admin.blog-sections.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-tag"></i>
                                        <p>Blog Sections</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Settings --}}
                        <li class="nav-header">Pengaturan</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.security.index') }}"
                               class="nav-link {{ request()->routeIs('admin.security.*') || request()->routeIs('admin.2fa.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shield-alt"></i>
                                <p>Keamanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.admission-announcements.index') }}"
                               class="nav-link {{ request()->routeIs('admin.admission-announcements.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-bullhorn"></i>
                                <p>Popup Pendaftaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.site-settings.index') }}"
                               class="nav-link {{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sliders-h"></i>
                                <p>Site Settings</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        {{-- ── Content ─────────────────────────────────── --}}
        @yield('content')

        {{-- ── Footer ──────────────────────────────────── --}}
        <footer class="main-footer">
            &copy; {{ now()->year }} Admin Panel &mdash; Magister Teknik Sipil UNMUL
        </footer>

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    {{-- ── Scripts ──────────────────────────────────── --}}
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

        $(function () {
            /* Sidebar collapse persistence */
            const collapsed = localStorage.getItem('admin_sidebar_collapsed') === '1';
            if (collapsed) $('body').addClass('sidebar-collapse');

            $(document).on('collapsed.lte.pushmenu', function () {
                localStorage.setItem('admin_sidebar_collapsed', '1');
            });
            $(document).on('shown.lte.pushmenu', function () {
                localStorage.setItem('admin_sidebar_collapsed', '0');
            });

            /* Plugins */
            if ($.fn.selectpicker) $('.selectpicker').selectpicker();

            if ($.fn.select2) {
                $('.select2').select2({ theme: 'bootstrap4' });
            }

            /* DataTables */
            if ($('#example1').length) {
                $('#example1').DataTable({
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    pageLength: 25,
                    order: [],
                    buttons: ['copy', 'excel', 'pdf', 'colvis']
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            }

            if ($('#example11').length) {
                $('#example11').DataTable({
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
                    searching: false,
                    paging: false,
                    info: false
                });
            }

            /* Auto-dismiss alerts */
            setTimeout(function () { $('.alert').fadeOut('slow'); }, 3500);
        });
    </script>
    @stack('scripts')
    @stack('modals')
</body>
</html>
