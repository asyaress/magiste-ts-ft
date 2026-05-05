@extends('layout/main')

@section('title', 'Dashboard · Admin Magister Teknik Sipil UNMUL')

@section('content')
<div class="content-wrapper">

    {{-- ── Page Header ──────────────────────────── --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap:12px;">
                <div>
                    <h1 class="m-0">Dashboard</h1>
                    <p class="page-subtitle">Selamat datang kembali, {{ auth()->user()->name }}</p>
                </div>
                <a href="{{ url('/') }}" target="_blank" rel="noopener"
                   class="btn btn-outline-primary" style="display:inline-flex;align-items:center;gap:6px;">
                    <i class="fas fa-external-link-alt" style="font-size:11px;"></i> Preview Website
                </a>
            </div>
        </div>
    </div>

    {{-- ── Content ──────────────────────────────── --}}
    <div class="content">
        <div class="container-fluid">

        {{-- Stat Cards Row 1 --}}
        <div class="row" style="margin-bottom:16px;">
            <div class="col-xl-3 col-md-6 mb-3">
                <a href="{{ route('admin.research-topics.index') }}" class="stat-card">
                    <div class="stat-icon stat-icon-blue">
                        <i class="fas fa-flask"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['research_topics'] }}</div>
                        <div class="stat-label">Research Topics</div>
                        <div class="stat-link">Kelola <i class="fas fa-arrow-right" style="font-size:10px;"></i></div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <a href="{{ route('admin.gallery-items.index') }}" class="stat-card">
                    <div class="stat-icon stat-icon-green">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['gallery_items'] }}</div>
                        <div class="stat-label">Gallery Items</div>
                        <div class="stat-link">Kelola <i class="fas fa-arrow-right" style="font-size:10px;"></i></div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <a href="{{ route('admin.teachers.index') }}" class="stat-card">
                    <div class="stat-icon stat-icon-purple">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['teachers'] }}</div>
                        <div class="stat-label">Dosen &amp; Staf</div>
                        <div class="stat-link">Kelola <i class="fas fa-arrow-right" style="font-size:10px;"></i></div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <a href="{{ route('admin.blog-posts.index') }}" class="stat-card">
                    <div class="stat-icon stat-icon-orange">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['blog_posts'] }}</div>
                        <div class="stat-label">Berita &amp; Artikel</div>
                        <div class="stat-link">Kelola <i class="fas fa-arrow-right" style="font-size:10px;"></i></div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Main Content Row --}}
        <div class="row">

            {{-- Latest Posts Table --}}
            <div class="col-lg-8 mb-3">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title">Berita Terbaru</h3>
                        <a href="{{ route('admin.blog-posts.index') }}"
                           style="font-size:12.5px;color:#f97316;font-weight:600;text-decoration:none;">
                            Lihat semua &rarr;
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th style="width:100px;">Status</th>
                                    <th style="width:130px;">Publish At</th>
                                    <th style="width:70px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestPosts as $post)
                                    <tr>
                                        <td>
                                            <span style="font-weight:500;color:#1e293b;">{{ $post->title }}</span>
                                        </td>
                                        <td>
                                            @if($post->is_published && $post->published_at)
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-secondary">Draft</span>
                                            @endif
                                        </td>
                                        <td style="color:#64748b;font-size:12.5px;">
                                            {{ optional($post->published_at)->format('d M Y') ?: '—' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.blog-posts.edit', $post) }}"
                                               class="btn btn-sm btn-outline-primary">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5" style="color:#94a3b8;">
                                            <i class="fas fa-newspaper" style="font-size:24px;display:block;margin-bottom:8px;"></i>
                                            Belum ada artikel
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="col-lg-4">

                {{-- Home Content Stats --}}
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Ringkasan Konten</h3>
                    </div>
                    <div class="card-body" style="padding-bottom:8px !important;">
                        @php
                            $summaryItems = [
                                ['label' => 'Hero Slides',    'value' => $stats['hero_slides'],    'icon' => 'fa-images',    'color' => '#2563eb'],
                                ['label' => 'Mission Items',  'value' => $stats['mission_items'],  'icon' => 'fa-bullseye',  'color' => '#16a34a'],
                                ['label' => 'FAQ Items',      'value' => $stats['faq_items'],      'icon' => 'fa-question-circle', 'color' => '#d97706'],
                                ['label' => 'Video Items',    'value' => $stats['video_items'],    'icon' => 'fa-video',     'color' => '#9333ea'],
                                ['label' => 'Blog Published', 'value' => $stats['blog_published'], 'icon' => 'fa-check-circle', 'color' => '#0d9488'],
                            ];
                        @endphp
                        @foreach($summaryItems as $item)
                            <div class="d-flex align-items-center justify-content-between"
                                 style="padding:9px 0;border-bottom:1px solid #f1f5f9;">
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div style="width:28px;height:28px;border-radius:7px;background:{{ $item['color'] }}1a;
                                                display:flex;align-items:center;justify-content:center;">
                                        <i class="fas {{ $item['icon'] }}" style="font-size:12px;color:{{ $item['color'] }};"></i>
                                    </div>
                                    <span style="font-size:13px;color:#475569;font-weight:500;">{{ $item['label'] }}</span>
                                </div>
                                <span style="font-size:15px;font-weight:700;color:#1e293b;">{{ $item['value'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Quick Access --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Akses Cepat</h3>
                    </div>
                    <div class="card-body">
                        @php
                            $quickLinks = [
                                ['label' => 'Hero Slides',    'url' => route('admin.home-hero-slides.index'), 'icon' => 'fa-images'],
                                ['label' => 'Video Sections', 'url' => route('admin.video-sections.index'),   'icon' => 'fa-film'],
                                ['label' => 'Site Settings',  'url' => route('admin.site-settings.index'),   'icon' => 'fa-sliders-h'],
                            ];
                        @endphp
                        <div style="display:flex;flex-direction:column;gap:8px;">
                            @foreach($quickLinks as $link)
                                <a href="{{ $link['url'] }}"
                                   style="display:flex;align-items:center;gap:10px;padding:10px 12px;
                                          background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;
                                          font-size:13px;font-weight:500;color:#1e293b;text-decoration:none;
                                          transition:border-color .15s,background .15s;"
                                   onmouseover="this.style.borderColor='#f97316';this.style.background='#fff7ed';"
                                   onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';">
                                    <i class="fas {{ $link['icon'] }}" style="font-size:13px;color:#f97316;width:16px;text-align:center;"></i>
                                    {{ $link['label'] }}
                                    <i class="fas fa-chevron-right" style="font-size:10px;color:#cbd5e1;margin-left:auto;"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

        </div>{{-- /container-fluid --}}
    </div>
</div>
@endsection
