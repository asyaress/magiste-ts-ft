@extends('layouts.app')

@section('title', $post->title . ' | Magister Teknik Sipil Unmul')

@section('content')
    <section class="breadcrumb-area"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb-1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title mt-20">
                            <h2>{{ $post->title }}</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span class="fa fa-angle-right"></span></li>
                                <li><a href="{{ route('blog.index') }}">Berita</a></li>
                                <li><span class="fa fa-angle-right"></span></li>
                                <li class="active">
                                    Detail
                                    <i class="flaticon-right-arrow-1 arrow1"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-style1-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <article class="single-blog-style1 mb-4">
                        <div class="img-holder mb-3">
                            <div class="inner">
                                <img src="{{ $post->image_url ?? asset('assets/images/blog/blog-v1-1.jpg') }}"
                                    alt="{{ $post->image_alt ?? $post->title }}">
                            </div>
                        </div>
                        <div class="text-holder">
                            @if($post->excerpt)
                                <p><strong>{{ $post->excerpt }}</strong></p>
                            @endif

                            @if($post->body)
                                @php
                                    $hasHtmlMarkup = $post->body !== strip_tags($post->body);
                                @endphp
                                <div class="text">
                                    @if($hasHtmlMarkup)
                                        {!! $post->body !!}
                                    @else
                                        {!! nl2br(e($post->body)) !!}
                                    @endif
                                </div>
                            @else
                                <div class="text">
                                    <p>Konten detail artikel belum ditambahkan.</p>
                                </div>
                            @endif
                        </div>
                    </article>

                    <a href="{{ route('blog.index') }}" class="btn-one">
                        <span class="txt">Kembali ke Daftar Berita <i class="flaticon-right-arrow-1 arrow1"></i></span>
                    </a>
                </div>

                <div class="col-xl-4 col-lg-4">
                    <div class="sidebar-wrapper">
                        <div class="single-sidebar mb-4">
                            <div class="title">
                                <h3>Artikel Terbaru</h3>
                            </div>
                            <ul class="list-unstyled mt-3">
                                @forelse($latestPosts as $latest)
                                    <li class="mb-3">
                                        <a href="{{ route('blog.show', $latest->slug) }}">
                                            {{ $latest->title }}
                                        </a>
                                        <div class="text-muted small">
                                            {{ optional($latest->published_at)->format('d M Y') }}
                                        </div>
                                    </li>
                                @empty
                                    <li class="text-muted">Belum ada artikel lain.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
