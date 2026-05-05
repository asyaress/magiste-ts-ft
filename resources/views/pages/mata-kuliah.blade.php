@extends('layouts.app')

@section('title', 'Mata Kuliah - Magister Teknik Sipil Universitas Mulawarman')

@section('content')
    {{-- BREADCRUMB --}}
    <section class="breadcrumb-area"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb-1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title mt-20">
                            <h2>Mata Kuliah</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span class="fa fa-angle-right"></span></li>
                                <li class="active">
                                    Mata Kuliah
                                    <i class="flaticon-right-arrow-1 arrow1"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MATA KULIAH (PDF PREVIEW + DOWNLOAD) --}}
    <section class="team-style1-area pdt120 pdb120" id="mata-kuliah">
        <div class="container">
            <div class="sec-title text-center pt-4">
                <h2>Mata Kuliah</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10">
                    <div class="text-center mb-4">
                        <p>
                            Daftar mata kuliah Program Studi Magister (S2) Teknik Sipil Universitas Mulawarman
                            mencakup mata kuliah wajib dan pilihan pada peminatan Struktur, Transportasi,
                            serta Keairan &amp; Geoteknik, yang dirancang untuk mendukung pencapaian
                            capaian pembelajaran lulusan secara komprehensif.
                        </p>
                    </div>

                    @php
                        // Sesuaikan path PDF dengan lokasi file daftar mata kuliah kamu
                        $pdfMataKuliah = asset('assets/pdf/mata-kuliah/mata-kuliah-s2-ts.pdf');
                    @endphp

                    {{-- TOMBOL DOWNLOAD --}}
                    <div class="text-center mb-3">
                        <a href="{{ $pdfMataKuliah }}" class="btn btn-primary" download>
                            Download Daftar Mata Kuliah (PDF)
                        </a>
                    </div>

                    {{-- PREVIEW PDF --}}
                    <div class="pdf-wrapper" style="border: 1px solid #eee; border-radius: 4px; overflow: hidden;">
                        <iframe src="{{ $pdfMataKuliah }}#toolbar=1"
                            style="width: 100%; height: 700px; border: none;"></iframe>
                    </div>

                    {{-- FALLBACK JIKA BROWSER TIDAK MENDUKUNG PREVIEW --}}
                    <div class="text-center mt-2">
                        <small>
                            Jika PDF tidak tampil, silakan
                            <a href="{{ $pdfMataKuliah }}" target="_blank" rel="noopener">
                                buka Dokumen Mata Kuliah di tab baru
                            </a>.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
