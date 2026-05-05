@extends('layouts.app')

@section('title', 'Penelitian dan Pengabdian - Magister Teknik Sipil Universitas Mulawarman')

@section('content')
    {{-- BREADCRUMB --}}
    <section class="breadcrumb-area"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb-1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title mt-20">
                            <h2>Penelitian & Pengabdian</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span class="fa fa-angle-right"></span></li>
                                <li class="active">
                                    Penelitian & Pengabdian
                                    <i class="flaticon-right-arrow-1 arrow1"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- KONTEN DATA --}}
    <section class="team-style1-area pdt120 pdb120" id="data-akademik">
        <div class="container">
            <div class="sec-title text-center pt-4">
                <h2>Database Riset & Pengabdian</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-11 col-lg-11">

                    {{-- INTRO & NAVIGASI CEPAT --}}
                    <div class="text-center mb-5">
                        <p class="mb-4">
                            Berikut adalah rekapitulasi data Penelitian dan Pengabdian kepada Masyarakat
                            yang dilakukan oleh Dosen dan Mahasiswa Program Studi Magister Teknik Sipil
                            Universitas Mulawarman.
                        </p>

                        {{-- Tombol Navigasi Cepat (Agar user Mobile mudah pindah tabel) --}}
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <a href="#tabel-penelitian" class="btn btn-primary btn-sm mx-1 my-1">
                                <i class="fa fa-arrow-down"></i> Lihat Data Penelitian
                            </a>
                            <a href="#tabel-pengabdian" class="btn btn-outline-primary btn-sm mx-1 my-1">
                                <i class="fa fa-arrow-down"></i> Lihat Data Pengabdian
                            </a>
                        </div>
                    </div>

                    @php
                        // --- KONFIGURASI LINK SPREADSHEET ---

                        // 1. Link Spreadsheet PENELITIAN
                        $linkPenelitian = "https://docs.google.com/spreadsheets/d/e/2PACX-1vTFDQZ5DI-Q2ptRsZ-Vi1XQJuiGn74ox81uyNuIt0Qe0xnzwZm0T0qkkn5LkWxCiGJkguWPgx-1jDZM/pubhtml?gid=1445544095&single=true&widget=true&headers=false";

                        // 2. Link Spreadsheet PENGABDIAN (Link Baru)
                        $linkPengabdian = "https://docs.google.com/spreadsheets/d/e/2PACX-1vTFDQZ5DI-Q2ptRsZ-Vi1XQJuiGn74ox81uyNuIt0Qe0xnzwZm0T0qkkn5LkWxCiGJkguWPgx-1jDZM/pubhtml?gid=1963231062&single=true&widget=true&headers=false";
                    @endphp

                    {{-- ================================================== --}}
                    {{-- TABEL 1: PENELITIAN --}}
                    {{-- ================================================== --}}
                    <div id="tabel-penelitian" class="card shadow-sm mb-5 border-0" style="scroll-margin-top: 100px;">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-box mr-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fa fa-flask"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0 text-primary">Data Penelitian</h4>
                                    <small class="text-muted">Rekapitulasi judul dan status penelitian</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            {{-- Wrapper Responsif --}}
                            <div class="embed-responsive-wrapper" style="position: relative; width: 100%; height: 700px; overflow: hidden;">
                                <iframe src="{{ $linkPenelitian }}"
                                    style="width: 100%; height: 100%; border: none;">
                                </iframe>
                            </div>
                        </div>
                    </div>

                    {{-- ================================================== --}}
                    {{-- TABEL 2: PENGABDIAN --}}
                    {{-- ================================================== --}}
                    <div id="tabel-pengabdian" class="card shadow-sm border-0" style="scroll-margin-top: 100px;">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-box mr-3 bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fa fa-users"></i> {{-- Ikon diganti jadi Users/Masyarakat --}}
                                </div>
                                <div>
                                    <h4 class="mb-0 text-success">Data Pengabdian</h4>
                                    <small class="text-muted">Kegiatan pengabdian kepada masyarakat (PKM)</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            {{-- Wrapper Responsif --}}
                            <div class="embed-responsive-wrapper" style="position: relative; width: 100%; height: 700px; overflow: hidden;">
                                <iframe src="{{ $linkPengabdian }}"
                                    style="width: 100%; height: 100%; border: none;">
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
