@extends('layouts.app')

@section('title', 'Tenaga Pendidik - Magister Teknik Sipil Universitas Mulawarman')

@section('content')
    {{-- BREADCRUMB --}}
    <section class="breadcrumb-area"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb-1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title">
                            <h2>Tenaga Pendidik</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span class="fa fa-angle-right"></span></li>
                                <li class="active">
                                    Tenaga Pendidik
                                    <i class="flaticon-right-arrow-1 arrow1"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TEAM / TENAGA PENDIDIK --}}
    <section class="team-style1-area" id="{{ $section->slug }}">
        <div class="container">
            <div class="sec-title text-center">
                @if($section->subtitle)
                    <div class="sub-title">
                        <!-- <p>{{ $section->subtitle }}</p> -->
                    </div>
                @endif
                <h2>{{ $section->title }}</h2>
            </div>

            <div class="row text-right-rtl">
                @forelse($section->teachers as $t)
                    <div class="{{ $t->col_classes }} {{ $t->wow_animation_class }}"
                        data-wow-delay="{{ $t->animation_delay_ms }}ms" data-wow-duration="{{ $t->animation_duration_ms }}ms">
                        <div class="single-team-item">
                            <div class="img-holder">
                                <div class="inner">
                                    <img src="{{ $t->photo_url ?? asset('assets/images/team/team-v1-4.jpg') }}"
                                        alt="{{ $t->photo_alt ?? $t->name }}">
                                </div>
                                ...
                            </div>
                            <div class="title-holder">
                                <h3><a href="{{ $t->profile_url ?? '#' }}">{{ $t->name }}</a></h3>
                                @if($t->tagline)
                                    <p>{{ $t->tagline }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada data pengajar.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>


    {{-- PARTNER / MITRA (opsional, bisa kamu ganti jadi logo mitra teknik sipil) --}}
    <!-- <section class="partner-area bg_white">
            <div class="container">
                <ul class="partner-box bg-gray partner-carousel owl-carousel owl-theme">
                    <li class="single-partner-logo-box">
                        <a href="#">
                            <img src="{{ asset('assets/images/brand/brand-logo-1.png') }}" alt="Mitra 1">
                        </a>
                        <div class="overlay">
                            <a href="#">
                                <img src="{{ asset('assets/images/brand/brand-logo-1-overlay.png') }}" alt="Mitra 1">
                            </a>
                        </div>
                    </li>

                    <li class="single-partner-logo-box">
                        <a href="#">
                            <img src="{{ asset('assets/images/brand/brand-logo-2.png') }}" alt="Mitra 2">
                        </a>
                        <div class="overlay">
                            <a href="#">
                                <img src="{{ asset('assets/images/brand/brand-logo-2-overlay.png') }}" alt="Mitra 2">
                            </a>
                        </div>
                    </li>

                    <li class="single-partner-logo-box">
                        <a href="#">
                            <img src="{{ asset('assets/images/brand/brand-logo-3.png') }}" alt="Mitra 3">
                        </a>
                        <div class="overlay">
                            <a href="#">
                                <img src="{{ asset('assets/images/brand/brand-logo-3-overlay.png') }}" alt="Mitra 3">
                            </a>
                        </div>
                    </li>

                    <li class="single-partner-logo-box">
                        <a href="#">
                            <img src="{{ asset('assets/images/brand/brand-logo-4.png') }}" alt="Mitra 4">
                        </a>
                        <div class="overlay">
                            <a href="#">
                                <img src="{{ asset('assets/images/brand/brand-logo-4-overlay.png') }}" alt="Mitra 4">
                            </a>
                        </div>
                    </li>

                    <li class="single-partner-logo-box">
                        <a href="#">
                            <img src="{{ asset('assets/images/brand/brand-logo-5.png') }}" alt="Mitra 5">
                        </a>
                        <div class="overlay">
                            <a href="#">
                                <img src="{{ asset('assets/images/brand/brand-logo-5-overlay.png') }}" alt="Mitra 5">
                            </a>
                        </div>
                    </li>

                    <li class="single-partner-logo-box">
                        <a href="#">
                            <img src="{{ asset('assets/images/brand/brand-logo-6.png') }}" alt="Mitra 6">
                        </a>
                        <div class="overlay">
                            <a href="#">
                                <img src="{{ asset('assets/images/brand/brand-logo-6-overlay.png') }}" alt="Mitra 6">
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </section> -->
@endsection
