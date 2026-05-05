@extends('layouts.app')

{{-- ===== META TAGS & SEO ===== --}}
@section('title', 'Program Magister Teknik Sipil | Universitas Mulawarman')

@push('meta')
    {{-- Primary Meta Tags --}}
    <meta name="title" content="Program Magister Teknik Sipil S2 - Universitas Mulawarman">
    <meta name="description"
        content="Program Magister Teknik Sipil Universitas Mulawarman (UNMUL) Samarinda. Pendidikan pascasarjana terbaik dengan fokus infrastruktur, struktur, dan teknologi konstruksi modern.">
    <meta name="keywords"
        content="magister teknik sipil, S2 teknik sipil, pascasarjana unmul, teknik sipil samarinda, program magister unmul, konstruksi, infrastruktur">
    <meta name="author" content="Universitas Mulawarman">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="language" content="id">
    <meta name="revisit-after" content="7 days">
    <meta name="rating" content="general">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Program Magister Teknik Sipil S2 - Universitas Mulawarman">
    <meta property="og:description"
        content="Program Magister Teknik Sipil Universitas Mulawarman (UNMUL) Samarinda. Pendidikan pascasarjana terbaik dengan fokus infrastruktur, struktur, dan teknologi konstruksi modern.">
    <meta property="og:image" content="{{ asset('assets/images/og-image.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Teknik Sipil S2 UNMUL">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Program Magister Teknik Sipil S2 - Universitas Mulawarman">
    <meta name="twitter:description"
        content="Program Magister Teknik Sipil Universitas Mulawarman (UNMUL) Samarinda. Pendidikan pascasarjana terbaik dengan fokus infrastruktur, struktur, dan teknologi konstruksi modern.">
    <meta name="twitter:image" content="{{ asset('assets/images/og-image.jpg') }}">

    {{-- Geo Tags untuk Local SEO --}}
    <meta name="geo.region" content="ID-KI">
    <meta name="geo.placename" content="Samarinda">
    <meta name="geo.position" content="-0.502106;117.153709">
    <meta name="ICBM" content="-0.502106, 117.153709">
@endpush

@push('structured-data')
    {{-- JSON-LD Structured Data untuk SEO --}}
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "EducationalOrganization",
            "name": "Program Magister Teknik Sipil Universitas Mulawarman",
            "alternateName": "S2 Teknik Sipil UNMUL",
            "url": "{{ url()->current() }}",
            "logo": "{{ asset('assets/images/logo.png') }}",
            "image": "{{ asset('assets/images/og-image.jpg') }}",
            "description": "Program Magister Teknik Sipil Universitas Mulawarman (UNMUL) Samarinda. Pendidikan pascasarjana terbaik dengan fokus infrastruktur, struktur, dan teknologi konstruksi modern.",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Jl. Kuaro",
                "addressLocality": "Samarinda",
                "addressRegion": "Kalimantan Timur",
                "postalCode": "75119",
                "addressCountry": "ID"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "contactType": "Admissions",
                "telephone": "+62-xxx-xxxx-xxxx",
                "email": "teksipil@unmul.ac.id"
            },
            "sameAs": [
                "https://www.facebook.com/unmul.official",
                "https://www.instagram.com/unmul.official",
                "https://twitter.com/unmul_official"
            ]
        }
    </script>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "Teknik Sipil S2 UNMUL",
            "url": "{{ url('/') }}",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{{ url('/') }}/search?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>
@endpush

@section('content')
    {{-- ===== Modal Leaflet PMB (modern) ===== --}}
    <div id="leafletModal" class="leaflet-backdrop" role="dialog" aria-modal="true" aria-labelledby="leafletTitle"
        style="display:none;">
        <div class="leaflet-dialog animate__animated" onclick="event.stopPropagation();">
            <div class="leaflet-accent" aria-hidden="true"></div>
            <button type="button" class="leaflet-close" aria-label="Tutup modal" title="Tutup">
                &times;
            </button>
            <img src="{{ asset('assets/images/leaflet.jpg') }}"
                alt="Leaflet Penerimaan Mahasiswa Baru Program Magister Teknik Sipil UNMUL" id="leafletImg"
                loading="eager" width="1200" height="1600" />
        </div>
    </div>

    {{-- ===== Halaman Utama ===== --}}
    @include('partials.sections.hero-slider')
    @include('partials.sections.services')
    @include('partials.sections.about')

    @if (!empty($researchSection))
        @include('partials.sections.projects', ['section' => $researchSection])
    @endif

    @if (!empty($videoSection))
        @include('partials.sections.video-gallery', ['section' => $videoSection])
    @endif

    @if (!empty($gallerySection))
        @include('partials.sections.gallery', ['section' => $gallerySection])
    @endif

    @if (!empty($teacherSection))
        @include('partials.sections.team', ['section' => $teacherSection])
    @endif

    @include('partials.sections.faq')

    @if (!empty($blogSection))
        @include('partials.sections.blog', ['section' => $blogSection])
    @endif
@endsection

{{-- ===== Styles & Scripts ===== --}}
@push('styles')
    {{-- Animate.css (CDN) untuk animasi modal --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-b7nNvGosbYQqQfQ2E8C6wYQb1jS2hM8v1b3xYc2qF7g0aTqT2wA3gM8lHk9d86l1f4b9K2qsgmQXQ1qWZ0C4nQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --brand: #FF6600;
            --radius: 18px;
            --shadow: 0 24px 70px rgba(0, 0, 0, .35);
        }

        .leaflet-backdrop {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, .72);
            backdrop-filter: blur(2px);
            padding: min(3vw, 24px);
        }

        .leaflet-dialog {
            position: relative;
            background: #fff;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            max-width: 96vw;
            max-height: 96vh;
            display: flex;
            align-items: center;
            justify-content: center;
            animation-duration: .6s;
            transform-origin: center;
            isolation: isolate;
        }

        .leaflet-dialog img {
            display: block;
            width: auto;
            height: auto;
            max-width: min(96vw, 1200px);
            max-height: 96vh;
            border-radius: calc(var(--radius) - 2px);
        }

        .leaflet-accent {
            position: absolute;
            inset: 0 auto auto 0;
            height: 6px;
            width: 100%;
            background: linear-gradient(90deg, var(--brand), #ff7f2a);
            z-index: 1;
        }

        .leaflet-close {
            position: absolute;
            top: 10px;
            right: 12px;
            z-index: 999;
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 2px solid var(--brand);
            background: #fff;
            color: #111;
            font-size: 22px;
            line-height: 1;
            cursor: pointer;
            transition: transform .15s ease, background .15s ease, color .15s ease;
            box-shadow: 0 4px 14px rgba(0, 0, 0, .15);
        }

        .leaflet-close:hover {
            background: var(--brand);
            color: #fff;
            transform: scale(1.04);
        }

        .leaflet-close:focus {
            outline: 2px solid var(--brand);
            outline-offset: 3px;
        }

        .leaflet-backdrop,
        .leaflet-dialog {
            will-change: opacity, transform;
        }

        .animate__fadeOut,
        .animate__zoomOut,
        .animate__fadeIn,
        .animate__zoomIn {
            --animate-duration: 0.35s !important;
            animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        (function() {
            'use strict';

            const modal = document.getElementById('leafletModal');
            if (!modal) return console.error('❌ Modal tidak ditemukan di DOM');

            const dialog = modal.querySelector('.leaflet-dialog');
            const closeBtn = modal.querySelector('.leaflet-close');
            const KEY = 'leafletShown';

            function lockScroll(lock) {
                document.documentElement.style.overflow = lock ? 'hidden' : '';
                document.body.style.overflow = lock ? 'hidden' : '';
            }

            function showModal() {
                modal.style.display = 'flex';
                modal.classList.remove('animate__fadeOut');
                dialog.classList.remove('animate__zoomOut');
                modal.classList.add('animate__animated', 'animate__fadeIn');
                dialog.classList.add('animate__animated', 'animate__zoomIn');
                lockScroll(true);
            }

            function hideModal() {
                modal.classList.remove('animate__fadeIn');
                dialog.classList.remove('animate__zoomIn');
                modal.classList.add('animate__animated', 'animate__fadeOut');
                dialog.classList.add('animate__animated', 'animate__zoomOut');

                setTimeout(() => {
                    modal.style.display = 'none';
                    modal.classList.remove('animate__animated', 'animate__fadeOut');
                    dialog.classList.remove('animate__animated', 'animate__zoomOut');
                    lockScroll(false);
                }, 350);
            }

            // Tampil sekali per sesi
            if (!sessionStorage.getItem(KEY)) {
                if (document.readyState === 'complete') {
                    showModal();
                } else {
                    window.addEventListener('load', showModal, {
                        once: true
                    });
                }
                sessionStorage.setItem(KEY, 'true');
            }

            // Event listeners
            if (closeBtn) {
                closeBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    hideModal();
                });
            }

            modal.addEventListener('click', (e) => {
                if (e.target === modal) hideModal();
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.style.display === 'flex') hideModal();
            });
        })();
    </script>
@endpush
