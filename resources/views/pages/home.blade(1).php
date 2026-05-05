@extends('layouts.app')
@section('title', 'Teknik Sipil S2 - Universitas Mulawarman')

{{-- ===== Modal Leaflet PMB (modern) ===== --}}
<div id="leafletModal" class="leaflet-backdrop" role="dialog" aria-modal="true" aria-labelledby="leafletTitle"
    style="display:none;">
    <div class="leaflet-dialog animate__animated" onclick="event.stopPropagation();">
        <div class="leaflet-accent" aria-hidden="true"></div>
        <button type="button" class="leaflet-close" aria-label="Tutup modal">
            &times;
        </button>
        <img src="{{ asset('assets/images/leaflet.png') }}" alt="Leaflet PMB S2 Teknik Sipil UNMUL" id="leafletImg"
            loading="eager" />
    </div>
</div>
@section('content')

    {{-- ===== Halaman Utama ===== --}}
    @include('partials.sections.hero-slider')
    @include('partials.sections.services')
    @include('partials.sections.about')
    @if(!empty($section))
        @include('partials.sections.projects', ['section' => $section])
    @endif
    @if(!empty($videoSection))
        @include('partials.sections.video-gallery', ['section' => $videoSection])
    @endif
    @if(!empty($gallerySection))
        @include('partials.sections.gallery', ['section' => $gallerySection])
    @endif
    @if(!empty($teacherSection))
        @include('partials.sections.team', ['section' => $teacherSection])
    @endif
    @include('partials.sections.faq')
    @if(!empty($blogSection))
        @include('partials.sections.blog', ['section' => $blogSection])
    @endif
@endsection


{{-- ===== Animate.css (CDN) untuk animasi) ===== --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    integrity="sha512-b7nNvGosbYQqQfQ2E8C6wYQb1jS2hM8v1b3xYc2qF7g0aTqT2wA3gM8lHk9d86l1f4b9K2qsgmQXQ1qWZ0C4nQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    :root {
        --brand: #FF6600;
        /* oranye sesuai request */
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
        /* kontrol durasi zoomIn/zoomOut */
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
        /* <<< pastikan di atas image */
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


    /* Smooth closing & opening */
    .leaflet-backdrop,
    .leaflet-dialog {
        will-change: opacity, transform;
    }

    /* durasi & easing animasi keluar */
    .animate__fadeOut,
    .animate__zoomOut {
        --animate-duration: 0.38s !important;
        animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    /* durasi & easing animasi masuk (opsional, biar konsisten halus) */
    .animate__fadeIn,
    .animate__zoomIn {
        --animate-duration: 0.38s !important;
        animation-timing-function: cubic-bezier(0.2, 0, 0, 1) !important;
    }

    /* Animasi smooth & cepat */
    .animate__fadeOut,
    .animate__zoomOut,
    .animate__fadeIn,
    .animate__zoomIn {
        --animate-duration: 0.35s !important;
        animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
</style>

<script>
    (function () {
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
            // hapus animasi masuk
            modal.classList.remove('animate__fadeIn');
            dialog.classList.remove('animate__zoomIn');
            // tambahkan animasi keluar
            modal.classList.add('animate__animated', 'animate__fadeOut');
            dialog.classList.add('animate__animated', 'animate__zoomOut');

            // bersihkan otomatis setelah durasi animasi (350 ms)
            setTimeout(() => {
                modal.style.display = 'none';
                modal.classList.remove('animate__animated', 'animate__fadeOut');
                dialog.classList.remove('animate__animated', 'animate__zoomOut');
                lockScroll(false);
            }, 350);
        }

        // tampil sekali per sesi
        if (!sessionStorage.getItem(KEY)) {
            if (document.readyState === 'complete') showModal();
            else window.addEventListener('load', showModal, { once: true });
            sessionStorage.setItem(KEY, 'true');
        }

        // tombol, backdrop, esc
        if (closeBtn) {
            closeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                hideModal();
            });
        }
        modal.addEventListener('click', (e) => { if (e.target === modal) hideModal(); });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') hideModal(); });
    })();
</script>
