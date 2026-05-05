<style>
    /* Header Main Container */
    .header.header-style4 {
        background: #ffffff;
        padding: 20px 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        position: relative;
        z-index: 10;
    }

    /* Sticky nav should be hidden by default and shown only when JS adds .fixed-header */
    .main-header .sticky-header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background: #ffffff;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-100%);
        transition: all 0.35s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .main-header.fixed-header .sticky-header {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .header.header-style4 .outer-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Logo Section */
    .header-left {
        flex-shrink: 0;
    }

    .header-left .logo {
        display: flex;
        align-items: center;
    }

    .header-left .logo img {
        width: 85px;
        height: 85px;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .header-left .logo:hover img {
        transform: scale(1.05);
    }

    /* Right Section */
    .header-right {
        margin-left: auto;
    }

    /* Contact Info Container */
    .header-contact-info2 {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 25px;
    }

    /* Location Info */
    .location-info {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 4px solid #ff6b00;
    }

    .location-info .icon {
        flex-shrink: 0;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ff6b00 0%, #ff8534 100%);
        border-radius: 50%;
        box-shadow: 0 3px 10px rgba(255, 107, 0, 0.25);
    }

    .location-info .icon span {
        color: #ffffff;
        font-size: 20px;
    }

    .location-info .text {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .location-info .text p {
        margin: 0;
        font-size: 11px;
        color: #666666;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }

    .location-info .text h4 {
        margin: 0;
        font-size: 13px;
        color: #333333;
        line-height: 1.5;
        font-weight: 600;
    }

    /* CTA Button */
    .btn-hubungi-kami {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 28px;
        border-radius: 50px;
        border: 2px solid #ff6b00;
        background: linear-gradient(135deg, #ff6b00 0%, #ff8534 100%);
        color: #ffffff;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-size: 13px;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(255, 107, 0, 0.3);
        transition: all 0.3s ease;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-hubungi-kami:hover {
        background: #ffffff;
        color: #ff6b00;
        border-color: #ff6b00;
        box-shadow: 0 6px 20px rgba(255, 107, 0, 0.4);
        transform: translateY(-2px);
    }

    .btn-hubungi-kami:active {
        transform: translateY(0);
        box-shadow: 0 2px 10px rgba(255, 107, 0, 0.3);
    }

    /* Icon inside button */
    .btn-hubungi-kami i {
        font-size: 16px;
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .header.header-style4 {
            padding: 15px 0;
        }

        .header-contact-info2 {
            gap: 15px;
        }

        .location-info {
            padding: 10px 15px;
        }

        .location-info .text h4 {
            font-size: 12px;
        }

        .btn-hubungi-kami {
            padding: 10px 22px;
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .header.header-style4 .outer-box {
            flex-direction: column;
            gap: 15px;
        }

        .header-left,
        .header-right {
            width: 100%;
            margin-left: 0;
        }

        .header-contact-info2 {
            flex-direction: column;
            gap: 12px;
            width: 100%;
            align-items: stretch;
        }

        .location-info {
            width: 100%;
            box-sizing: border-box;
        }

        .btn-hubungi-kami {
            width: 100%;
            padding: 14px 25px;
        }

        .header-left .logo {
            justify-content: center;
        }

        .header-left .logo img {
            width: 70px;
            height: 70px;
        }

        .location-info .icon {
            width: 40px;
            height: 40px;
        }

        .location-info .icon span {
            font-size: 18px;
        }

        .location-info .text p {
            font-size: 10px;
        }

        .location-info .text h4 {
            font-size: 11px;
        }
    }

    @media (max-width: 480px) {
        .header.header-style4 {
            padding: 10px 0;
        }

        .location-info {
            padding: 8px 12px;
        }

        .location-info .text h4 br {
            display: none;
        }

        .btn-hubungi-kami {
            font-size: 11px;
            padding: 12px 20px;
        }
    }

    /* Override default pull-right if needed */
    .header-right.pull-right {
        float: none !important;
    }

    .header-left.pull-left {
        float: none !important;
    }
</style>

<!--Start Header-->
<div class="header header-style4">
    <div class="container">
        <div class="outer-box">

            <!-- Logo Section -->
            <div class="header-left">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logots.jpg') }}" alt="Logo S2 Teknik Sipil UNMUL"
                            title="S2 Teknik Sipil UNMUL" />
                    </a>
                </div>
            </div>

            <!-- Right Section -->
            <div class="header-right">
                <div class="header-contact-info2">

                    <!-- Location Information -->
                    <div class="location-info">
                        <div class="icon">
                            <span class="flaticon-placeholder-1"></span>
                        </div>
                        <div class="text">
                            <p>{{ $siteSettings['header_location_label'] ?? 'Lokasi Kampus' }}</p>
                            <h4>{!! nl2br(e($siteSettings['header_location_text'] ?? "Gedung Fakultas Teknik, Jl. Sambaliung No.9\nKampus Gunung Kelua, Samarinda")) !!}</h4>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    @php
                        $waNumber = preg_replace('/[^0-9]/', '', ($kontak_wa ?? ''));
                        $waUrl = $waNumber ? 'https://wa.me/' . $waNumber : '#';
                        $ctaUrl = $siteSettings['contact_link_url'] ?? $waUrl;
                    @endphp
                    <a href="{{ $ctaUrl }}"
                        class="btn-hubungi-kami" target="_blank" rel="noopener noreferrer">
                        <i class="flaticon-phone-call-1"></i>
                        {{ $siteSettings['header_cta_text'] ?? 'Hubungi Kami' }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
<!--End Header-->
