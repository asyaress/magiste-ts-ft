@extends('layouts.app')

@section('title', 'Struktur Organisasi - Magister Teknik Sipil Universitas Mulawarman')

@section('content')
    {{-- BREADCRUMB --}}
    <section class="breadcrumb-area"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb-1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title mt-20">
                            <h2>Struktur Organisasi</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span class="fa fa-angle-right"></span></li>
                                <li class="active">
                                    Struktur Organisasi
                                    <i class="flaticon-right-arrow-1 arrow1"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STRUKTUR ORGANISASI (STATIS, 1 FOTO) --}}
    <section class="team-style1-area pdt120 pdb120" id="struktur-organisasi">
        <div class="container">
            <div class="sec-title text-center pt-4">
                <h2>Struktur Organisasi</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10">
                    <div class="text-center">
                        {{-- Ganti path gambar di bawah dengan file struktur organisasi kamu --}}
                        <img src="{{ asset('assets/images/struktur-organisasi/struktur-organisasi-s2-ts.png') }}"
                            alt="Struktur Organisasi Program Studi Magister (S2) Teknik Sipil Universitas Mulawarman"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
