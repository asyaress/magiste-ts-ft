@extends('layout/main')

@section('title', 'Dashboard Admin | Magister Teknik Sipil UNMUL')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div>
                        <h1 class="m-0">Dashboard Admin</h1>
                        <small class="text-muted">Ringkasan konten website dan akses cepat manajemen.</small>
                    </div>
                    <a href="{{ url('/') }}" target="_blank" rel="noopener" class="btn btn-outline-primary">
                        <i class="fas fa-external-link-alt mr-1"></i> Preview Website
                    </a>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $stats['research_topics'] }}</h3>
                                <p>Research Topics</p>
                            </div>
                            <div class="icon"><i class="fas fa-flask"></i></div>
                            <a href="{{ route('admin.research-topics.index') }}" class="small-box-footer">
                                Kelola <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $stats['gallery_items'] }}</h3>
                                <p>Gallery Items</p>
                            </div>
                            <div class="icon"><i class="fas fa-images"></i></div>
                            <a href="{{ route('admin.gallery-items.index') }}" class="small-box-footer">
                                Kelola <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $stats['teachers'] }}</h3>
                                <p>Teachers</p>
                            </div>
                            <div class="icon"><i class="fas fa-user-graduate"></i></div>
                            <a href="{{ route('admin.teachers.index') }}" class="small-box-footer">
                                Kelola <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $stats['blog_posts'] }}</h3>
                                <p>Berita & Artikel</p>
                            </div>
                            <div class="icon"><i class="fas fa-newspaper"></i></div>
                            <a href="{{ route('admin.blog-posts.index') }}" class="small-box-footer">
                                Kelola <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Berita Terbaru</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Status</th>
                                            <th>Publish At</th>
                                            <th class="text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($latestPosts as $post)
                                            <tr>
                                                <td>{{ $post->title }}</td>
                                                <td>
                                                    @if($post->is_published && $post->published_at)
                                                        <span class="badge badge-success">Published</span>
                                                    @else
                                                        <span class="badge badge-secondary">Draft</span>
                                                    @endif
                                                </td>
                                                <td>{{ optional($post->published_at)->format('d M Y H:i') ?: '-' }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('admin.blog-posts.edit', $post) }}"
                                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">Belum ada artikel.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Ringkasan Home</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Hero Slides</span>
                                    <strong>{{ $stats['hero_slides'] }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Mission Items</span>
                                    <strong>{{ $stats['mission_items'] }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>FAQ Items</span>
                                    <strong>{{ $stats['faq_items'] }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Video Items</span>
                                    <strong>{{ $stats['video_items'] }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-0">
                                    <span>Blog Published</span>
                                    <strong>{{ $stats['blog_published'] }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Akses Cepat</h3>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('admin.home-hero-slides.index') }}" class="btn btn-outline-primary btn-block mb-2">Home Hero Slides</a>
                                <a href="{{ route('admin.video-sections.index') }}" class="btn btn-outline-primary btn-block mb-2">Video Sections</a>
                                <a href="{{ route('admin.site-settings.index') }}" class="btn btn-outline-primary btn-block">Site Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

