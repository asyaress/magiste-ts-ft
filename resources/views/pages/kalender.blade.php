@extends('layouts.app')

@section('title', 'Kalender Akademik - Magister Teknik Sipil Universitas Mulawarman')

@section('content')
    {{-- BREADCRUMB --}}
    <section class="breadcrumb-area"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb-1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title mt-20">
                            <h2>Kalender Akademik</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span class="fa fa-angle-right"></span></li>
                                <li class="active">
                                    Kalender Akademik
                                    <i class="flaticon-right-arrow-1 arrow1"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- KALENDER AKADEMIK (PDF PREVIEW + DOWNLOAD) --}}
    <section class="team-style1-area pdt120 pdb120" id="kalender-akademik">
        <div class="container">
            <div class="sec-title text-center pt-4">
                <h2>Kalender Akademik</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10">
                    <div class="text-center mb-4">
                        <p>
                            Kalender akademik Program Studi Magister (S2) Teknik Sipil Universitas Mulawarman
                            memuat informasi penting terkait periode perkuliahan, registrasi, ujian,
                            libur akademik, dan kegiatan akademik lainnya pada setiap semester.
                        </p>
                    </div>

                    @php
                        // Sesuaikan path PDF dengan lokasi file kamu
                        $pdfKalender = asset('assets/pdf/akademik/kalender-akademik.pdf');
                    @endphp

                    {{-- TOMBOL DOWNLOAD --}}
                    <div class="text-center mb-3">
                        <a href="{{ $pdfKalender }}" class="btn btn-primary" download>
                            Download Kalender Akademik (PDF)
                        </a>
                    </div>

                    {{-- PREVIEW PDF --}}
                    <div class="pdf-wrapper" style="border: 1px solid #eee; border-radius: 4px; overflow: hidden;">
                        <iframe src="{{ $pdfKalender }}#toolbar=1"
                            style="width: 100%; height: 700px; border: none;"></iframe>
                    </div>

                    {{-- FALLBACK JIKA BROWSER TIDAK MENDUKUNG PREVIEW --}}
                    <div class="text-center mt-2">
                        <small>
                            Jika PDF tidak tampil, silakan
                            <a href="{{ $pdfKalender }}" target="_blank" rel="noopener">
                                buka Kalender Akademik di tab baru
                            </a>.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
