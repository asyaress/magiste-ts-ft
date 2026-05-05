@extends('layouts.app')

@section('title', 'Jadwal Perkuliahan - Magister Teknik Sipil Universitas Mulawarman')

@section('content')
    {{-- BREADCRUMB --}}
    <section class="breadcrumb-area"
        style="background-image: url({{ asset('assets/images/breadcrumb/breadcrumb-1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content">
                        <div class="title mt-20">
                            <h2>Jadwal Perkuliahan</h2>
                        </div>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span class="fa fa-angle-right"></span></li>
                                <li class="active">
                                    Jadwal Perkuliahan
                                    <i class="flaticon-right-arrow-1 arrow1"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- JADWAL PERKULIAHAN (STATIS, 1 FOTO) --}}
    <section class="team-style1-area pdt120 pdb120" id="jadwal-perkuliahan">
        <div class="container">
            <div class="sec-title text-center pt-4">
                <h2>Jadwal Perkuliahan</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10">
                    <div class="text-center mb-4">
                        <p>
                            Jadwal perkuliahan Program Studi Magister (S2) Teknik Sipil Universitas Mulawarman
                            disusun dengan mempertimbangkan fleksibilitas bagi mahasiswa, terutama yang telah
                            bekerja, dengan pelaksanaan kuliah pada hari <strong>Jumat</strong> dan
                            <strong>Sabtu</strong> dalam format <strong>luring dan daring (hybrid)</strong>.
                        </p>
                    </div>

                    <div class="text-center">
                        {{-- Ganti path gambar di bawah dengan tabel jadwal perkuliahan per semester --}}
                        <img src="{{ asset('assets/images/akademik/jadwal-kuliah-s2-ts.png') }}"
                            alt="Jadwal Perkuliahan Program Studi Magister (S2) Teknik Sipil Universitas Mulawarman"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
