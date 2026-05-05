@extends('layouts.app')

@section('title', 'Akreditasi - Magister Teknik Sipil Universitas Mulawarman')

@section('content')
    {{-- BREADCRUMB --}}
    <section class="breadcrumb-area"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb-1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title mt-20">
                            <h2>Akreditasi</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span class="fa fa-angle-right"></span></li>
                                <li class="active">
                                    Akreditasi
                                    <i class="flaticon-right-arrow-1 arrow1"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- AKREDITASI (PDF PREVIEW + DOWNLOAD) --}}
    <section class="team-style1-area pdt120 pdb120" id="akreditasi">
        <div class="container">
            <div class="sec-title text-center pt-4">
                <h2>Akreditasi Program Studi</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10">
                    <div class="text-center mb-4">
                        <p>
                            Program Studi Magister (S2) Teknik Sipil Universitas Mulawarman
                            telah memperoleh akreditasi dari lembaga akreditasi yang berwenang.
                            Berikut adalah sertifikat akreditasi program studi.
                        </p>
                    </div>

                    @php
                        $pdfUrl = asset('assets/pdf/akreditasi/akreditasi-s2-ts.pdf');
                    @endphp

                    {{-- TOMBOL DOWNLOAD --}}
                    <div class="text-center mb-3">
                        <a href="{{ $pdfUrl }}" class="btn btn-primary" download>
                            Download Sertifikat Akreditasi (PDF)
                        </a>
                    </div>

                    {{-- PREVIEW PDF --}}
                    <div class="pdf-wrapper" style="border: 1px solid #eee; border-radius: 4px; overflow: hidden;">
                        <iframe src="{{ $pdfUrl }}#toolbar=1" style="width: 100%; height: 700px; border: none;">
                        </iframe>
                    </div>

                    {{-- FALLBACK JIKA BROWSER TIDAK MENDUKUNG IFRAME PDF --}}
                    <div class="text-center mt-2">
                        <small>
                            Jika PDF tidak tampil, silakan
                            <a href="{{ $pdfUrl }}" target="_blank" rel="noopener">
                                buka file di tab baru
                            </a>.
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
