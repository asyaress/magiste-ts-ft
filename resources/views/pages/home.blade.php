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
