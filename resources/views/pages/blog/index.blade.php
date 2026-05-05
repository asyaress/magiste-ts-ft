@extends('layouts.app')

@section('title', 'Berita | Magister Teknik Sipil UNMUL')

@section('content')
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 py-4">
                    <h2 class="mb-2">Berita & Artikel</h2>
                    <p class="mb-0 text-muted">Update terbaru Program Magister Teknik Sipil Universitas Mulawarman.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-style1-area">
        <div class="container">
            <div class="row text-right-rtl">
                @forelse($posts as $post)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="single-blog-style1 wow fadeInUp mb-30" data-wow-duration="{{ $post->animation_duration_ms }}ms">
                            <div class="img-holder">
                                <div class="inner">
                                    <img src="{{ $post->image_url ?? asset('assets/images/blog/blog-v1-1.jpg') }}"
                                        alt="{{ $post->image_alt ?? $post->title }}">
                                    <div class="overlay-icon">
                                        <a href="{{ route('blog.show', $post->slug) }}">
                                            <span class="{{ $post->overlay_icon_class ?: 'flaticon-plus' }}"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="text-holder">
                                <ul class="meta-info">
                                    <li><i class="flaticon-calendar"></i> {{ optional($post->published_at)->format('d M Y') }}</li>
                                    <li><i class="flaticon-message"></i>{{ sprintf('%02d', $post->comment_count) }}</li>
                                </ul>
                                <h3 class="blog-title">
                                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                @if($post->excerpt)
                                    <div class="text">
                                        <p>{{ $post->excerpt }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            @if($posts->hasPages())
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $posts->onEachSide(1)->links() }}
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
