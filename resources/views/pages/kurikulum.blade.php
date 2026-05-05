@extends('layouts.app')

@section('title', 'Kurikulum - Magister Teknik Sipil Universitas Mulawarman')

@section('content')
    {{-- BREADCRUMB --}}
    <section class="breadcrumb-area"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb-1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title mt-20">
                            <h2>Kurikulum</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span class="fa fa-angle-right"></span></li>
                                <li class="active">
                                    Kurikulum
                                    <i class="flaticon-right-arrow-1 arrow1"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- KURIKULUM (2 PDF PREVIEW + DOWNLOAD) --}}
    <section class="team-style1-area pdt120 pdb120" id="kurikulum">
        <div class="container">
            <div class="sec-title text-center pt-4">
                <h2>Kurikulum Program Studi</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10">
                    <div class="text-center mb-4">
                        <p>
                            Kurikulum Program Studi Magister (S2) Teknik Sipil Universitas Mulawarman
                            disusun untuk mendukung pengembangan kompetensi di bidang Struktur,
                            Transportasi, serta Keairan &amp; Geoteknik, dengan total beban studi
                            <strong>54 SKS</strong> yang dapat ditempuh dalam minimal empat semester.
                            Rincian lengkap mata kuliah dan distribusi SKS dapat dilihat pada dokumen
                            berikut.
                        </p>
                    </div>

                    @php
                        // Sesuaikan path PDF-nya dengan file milikmu
                        $pdfSk = asset('assets/pdf/kurikulum/sk-kurikulum-s2-ts.pdf');
                        $pdfDok = asset('assets/pdf/kurikulum/dokumen-kurikulum-s2-ts.pdf');
                    @endphp

                    <div class="row mt-4">
                        {{-- SK KURIKULUM --}}
                        <div class="col-md-6 mb-4">
                            <div class="h-100"
                                style="border: 1px solid #eee; border-radius: 6px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,.05);">
                                <div class="p-3 p-md-4">
                                    <h4 class="mb-2 text-center">SK Kurikulum</h4>
                                    <p class="small text-muted text-center mb-3">
                                        Surat Keputusan penetapan kurikulum Program Studi Magister (S2)
                                        Teknik Sipil Universitas Mulawarman.
                                    </p>

                                    <div class="text-center mb-3">
                                        <a href="{{ $pdfSk }}" class="btn btn-primary btn-sm" download>
                                            Download SK Kurikulum (PDF)
                                        </a>
                                    </div>
                                </div>

                                <div style="border-top: 1px solid #eee;">
                                    <iframe src="{{ $pdfSk }}#toolbar=1"
                                        style="width: 100%; height: 450px; border: none;"></iframe>
                                </div>

                                <div class="text-center p-2">
                                    <small>
                                        Jika PDF tidak tampil, silakan
                                        <a href="{{ $pdfSk }}" target="_blank" rel="noopener">
                                            buka SK Kurikulum di tab baru
                                        </a>.
                                    </small>
                                </div>
                            </div>
                        </div>

                        {{-- DOKUMEN KURIKULUM --}}
                        <div class="col-md-6 mb-4">
                            <div class="h-100"
                                style="border: 1px solid #eee; border-radius: 6px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,.05);">
                                <div class="p-3 p-md-4">
                                    <h4 class="mb-2 text-center">Dokumen Kurikulum</h4>
                                    <p class="small text-muted text-center mb-3">
                                        Dokumen lengkap kurikulum, berisi struktur mata kuliah,
                                        distribusi SKS, serta deskripsi pembelajaran.
                                    </p>

                                    <div class="text-center mb-3">
                                        <a href="{{ $pdfDok }}" class="btn btn-primary btn-sm" download>
                                            Download Dokumen Kurikulum (PDF)
                                        </a>
                                    </div>
                                </div>

                                <div style="border-top: 1px solid #eee;">
                                    <iframe src="{{ $pdfDok }}#toolbar=1"
                                        style="width: 100%; height: 450px; border: none;"></iframe>
                                </div>

                                <div class="text-center p-2">
                                    <small>
                                        Jika PDF tidak tampil, silakan
                                        <a href="{{ $pdfDok }}" target="_blank" rel="noopener">
                                            buka Dokumen Kurikulum di tab baru
                                        </a>.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div> {{-- /.row --}}
                </div>
            </div>
        </div>
    </section>
@endsection
