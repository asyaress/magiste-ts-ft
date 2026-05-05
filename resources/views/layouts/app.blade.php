<!DOCTYPE html>
<html lang="id">

<head>
    {{-- ===== Basic Meta Tags ===== --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ===== Title ===== --}}
    <title>@yield('title', 'Teknik Sipil S2 - Universitas Mulawarman')</title>

    {{-- ===== Dynamic Meta Tags dari child views ===== --}}
    @stack('meta')

    {{-- ===== Default Meta Tags (hanya jika child view tidak set custom meta) ===== --}}
    @empty(trim($__env->yieldContent('meta')))
        <meta name="description"
            content="Program Magister Teknik Sipil Universitas Mulawarman (UNMUL) Samarinda. Pendidikan pascasarjana terbaik dengan fokus infrastruktur, struktur, dan teknologi konstruksi modern.">
        <meta name="keywords" content="magister teknik sipil, S2 teknik sipil, pascasarjana unmul, teknik sipil samarinda">
        <meta name="author" content="Universitas Mulawarman">
        <meta name="robots" content="index, follow, max-image-preview:large">

        {{-- Open Graph --}}
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="Program Magister Teknik Sipil S2 - Universitas Mulawarman">
        <meta property="og:description"
            content="Program Magister Teknik Sipil Universitas Mulawarman (UNMUL) Samarinda. Pendidikan pascasarjana terbaik dengan fokus infrastruktur, struktur, dan teknologi konstruksi modern.">
        <meta property="og:image" content="{{ asset('assets/images/og-image.jpg') }}">
        <meta property="og:site_name" content="Teknik Sipil S2 UNMUL">

        {{-- Twitter Card --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Program Magister Teknik Sipil S2 - Universitas Mulawarman">
        <meta name="twitter:description" content="Program Magister Teknik Sipil Universitas Mulawarman (UNMUL) Samarinda.">
        <meta name="twitter:image" content="{{ asset('assets/images/og-image.jpg') }}">

        {{-- Canonical URL --}}
        <link rel="canonical" href="{{ url()->current() }}">
    @endempty

    {{-- ===== Theme Color ===== --}}
    <meta name="theme-color" content="#FF6600">
    <meta name="msapplication-TileColor" content="#FF6600">

    {{-- ===== Preconnect untuk Performance ===== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://maps.googleapis.com">

    {{-- ===== CSS Global ===== --}}
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/imp.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/hiddenbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/color.css') }}">
    <link href="{{ asset('assets/css/color/theme-color.css') }}" id="jssDefault" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    {{-- ===== Additional Styles dari child views ===== --}}
    @stack('styles')

    {{-- ===== Favicon (SELALU LOAD, tidak conditional!) ===== --}}
    {{-- Primary favicon untuk modern browsers --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-16x16.png') }}">
    
    {{-- Fallback untuk older browsers --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    {{-- Apple Touch Icon untuk iOS --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-touch-icon.png') }}">
    
    {{-- Android Chrome --}}
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/android-chrome-192x192.png') }}">
    
    {{-- Web Manifest --}}
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    
    {{-- Microsoft Tiles (optional) --}}
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/mstile-150x150.png') }}">

    {{-- ===== Structured Data ===== --}}
    @stack('structured-data')

    {{-- ===== IE Support ===== --}}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @stack('head')
</head>

<body>
    <div class="boxed_wrapper ltr">

        {{-- ===== Utils ===== --}}
        @include('partials.preloader')
        @include('partials.page-direction')
        @include('partials.color-switcher')

        {{-- ===== Header ===== --}}
        @include('partials.header.header')

        {{-- ===== Page Content ===== --}}
        <main id="main-content" role="main">
            @yield('content')
        </main>

        {{-- ===== Footer ===== --}}
        @include('partials.footer.footer')
        @include('partials.footer.footer-bottom')

        {{-- ===== Utility Buttons ===== --}}
        @include('partials.scroll-top-button')
    </div>

    {{-- ===== JS Global ===== --}}
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/appear.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.bxslider.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.enllax.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.paroller.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.polyglot.language.switcher.js') }}"></script>
    <script src="{{ asset('assets/js/jQuery.style.switcher.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/knob.js') }}"></script>
    <script src="{{ asset('assets/js/map-script.js') }}"></script>
    <script src="{{ asset('assets/js/owl.js') }}"></script>
    <script src="{{ asset('assets/js/pagenav.js') }}"></script>
    <script src="{{ asset('assets/js/parallax.min.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/timePicker.js') }}"></script>
    <script src="{{ asset('assets/js/validation.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/TweenMax.min.js') }}"></script>

    {{-- ===== Google Maps ===== --}}
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATY4Rxc8jNvDpsK8ZetC7JyN4PFVYGCGM&callback=initMap">
    </script>

    {{-- ===== Custom JS ===== --}}
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    {{-- ===== Google Analytics (optional) ===== --}}
    @if(config('services.google.analytics_id'))
        <script async
            src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', '{{ config('services.google.analytics_id') }}');
        </script>
    @endif

    {{-- ===== Page-level scripts ===== --}}
    @stack('scripts')
</body>

</html>
