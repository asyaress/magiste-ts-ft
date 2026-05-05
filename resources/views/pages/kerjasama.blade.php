@extends('layouts.app')

@section('title', 'Kerjasama - Magister Teknik Sipil Universitas Mulawarman')

@section('content')
    {{-- BREADCRUMB --}}
    <section class="breadcrumb-area"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb-1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title mt-20">
                            <h2>Kerjasama</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span class="fa fa-angle-right"></span></li>
                                <li class="active">
                                    Kerjasama
                                    <i class="flaticon-right-arrow-1 arrow1"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- KONTEN DATA KERJASAMA --}}
    <section class="team-style1-area pdt120 pdb120" id="data-kerjasama">
        <div class="container">
            <div class="sec-title text-center pt-4">
                <h2>Data Kerjasama & Mitra</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-11 col-lg-11">

                    {{-- INTRO --}}
                    <div class="text-center mb-5">
                        <p class="mb-4">
                            Berikut adalah daftar Kerjasama (MoU/MoA) yang terjalin antara
                            Program Studi Magister Teknik Sipil Universitas Mulawarman dengan
                            berbagai instansi pemerintah, perusahaan swasta, dan institusi pendidikan lainnya.
                        </p>
                    </div>

                    @php
                        // --- KONFIGURASI LINK SPREADSHEET KERJASAMA ---
                        // Link khusus tab Kerjasama (gid=131723672)
                        $linkKerjasama = "https://docs.google.com/spreadsheets/d/e/2PACX-1vTFDQZ5DI-Q2ptRsZ-Vi1XQJuiGn74ox81uyNuIt0Qe0xnzwZm0T0qkkn5LkWxCiGJkguWPgx-1jDZM/pubhtml?gid=131723672&single=true&widget=true&headers=false";
                    @endphp

                    {{-- ================================================== --}}
                    {{-- TABEL KERJASAMA --}}
                    {{-- ================================================== --}}
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-box mr-3 bg-info text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;">
                                    <i class="fa fa-handshake-o"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0 text-info">Data Kerjasama</h4>
                                    <small class="text-muted">Daftar mitra kerjasama dalam dan luar negeri</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            {{-- Wrapper Responsif --}}
                            <div class="embed-responsive-wrapper"
                                style="position: relative; width: 100%; height: 800px; overflow: hidden;">
                                <iframe src="{{ $linkKerjasama }}" style="width: 100%; height: 100%; border: none;">
                                </iframe>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Note --}}
                    <div class="mt-4 text-center">
                        <small class="text-muted">
                            <i class="fa fa-info-circle"></i> Gunakan scroll di dalam tabel untuk melihat lebih banyak data.
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
