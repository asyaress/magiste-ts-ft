@if(!empty($activeAdmissionAnnouncement) && request()->routeIs('dashboard'))
    @php
        $popup = $activeAdmissionAnnouncement;
    @endphp

    <style>
        .modal.admission-popup-modal + .modal-backdrop.show {
            opacity: .74;
            background: #0a0f18;
            backdrop-filter: blur(2px);
        }

        .admission-popup-modal {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .admission-popup-modal .modal-dialog {
            max-width: 1040px;
            margin: 1rem auto;
        }

        .admission-popup-content {
            position: relative;
            border: 0;
            border-radius: 20px;
            overflow: hidden;
            background: #0f141d;
            box-shadow:
                0 30px 90px rgba(0, 0, 0, .45),
                0 0 0 1px rgba(255, 255, 255, .08) inset;
        }

        .admission-popup-content::before {
            content: "";
            position: absolute;
            inset: 0 auto auto 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #e74901 0%, #ff8a3d 52%, #ffd0ae 100%);
            z-index: 6;
        }

        .admission-popup-close {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 7;
            width: 40px;
            height: 40px;
            border: 0;
            border-radius: 50%;
            background: rgba(16, 23, 35, .82);
            color: #fff;
            font-size: 24px;
            line-height: 1;
            display: grid;
            place-items: center;
            cursor: pointer;
            transition: transform .2s ease, background .2s ease;
        }

        .admission-popup-close:hover {
            background: #e74901;
            transform: scale(1.06);
        }

        .admission-poster-wrap {
            line-height: 0;
            background: #0f141d;
        }

        .admission-poster-link,
        .admission-poster-link:hover {
            display: block;
            text-decoration: none;
        }

        .admission-poster-img {
            display: block;
            width: 100%;
            height: auto;
            max-height: 84vh;
            object-fit: contain;
            margin: 0 auto;
        }

        .admission-overlay-actions {
            position: absolute;
            right: 16px;
            bottom: 16px;
            z-index: 5;
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .admission-ghost-btn {
            border: 1px solid rgba(255, 255, 255, .25);
            background: rgba(16, 23, 35, .58);
            color: #fff;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 13px;
            border-radius: 999px;
            padding: 9px 16px;
            transition: all .2s ease;
            backdrop-filter: blur(5px);
        }

        .admission-ghost-btn:hover {
            border-color: rgba(255, 255, 255, .45);
            background: rgba(16, 23, 35, .8);
            color: #fff;
        }

        .admission-text-wrap {
            padding: 38px 32px 24px;
            background: radial-gradient(circle at 92% 0%, rgba(231, 73, 1, .12) 0, rgba(231, 73, 1, 0) 46%), #ffffff;
        }

        .admission-popup-kicker {
            margin: 0 0 10px;
            font-size: 12px;
            line-height: 1.3;
            letter-spacing: .08em;
            text-transform: uppercase;
            font-weight: 700;
            color: #e74901;
            font-family: 'Open Sans', sans-serif;
        }

        .admission-popup-title {
            margin: 0;
            font-size: 34px;
            line-height: 1.15;
            color: #11161e;
            font-weight: 800;
            letter-spacing: -.02em;
            font-family: 'Open Sans', sans-serif;
        }

        .admission-popup-subtitle {
            margin: 14px 0 0;
            font-size: 16px;
            line-height: 1.65;
            color: #5f6878;
            font-family: 'Open Sans', sans-serif;
        }

        .admission-popup-footer {
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: flex-start;
            padding: 4px 32px 28px;
            background: #ffffff;
        }

        .admission-popup-dismiss {
            border: 0;
            background: transparent;
            color: #708198;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 14px;
            padding: 8px 2px;
            transition: color .2s ease;
        }

        .admission-popup-dismiss:hover {
            color: #101a28;
        }

        @media (max-width: 991.98px) {
            .admission-poster-img {
                max-height: 76vh;
            }
        }

        @media (max-width: 767.98px) {
            .admission-popup-modal .modal-dialog {
                margin: .65rem auto;
            }

            .admission-popup-close {
                width: 36px;
                height: 36px;
                font-size: 21px;
            }

            .admission-overlay-actions {
                left: 12px;
                right: 12px;
                bottom: 12px;
                justify-content: center;
            }

            .admission-overlay-actions .btn-one {
                width: 100%;
                text-align: center;
            }

            .admission-ghost-btn {
                width: 100%;
                text-align: center;
            }

            .admission-text-wrap {
                padding: 28px 20px 18px;
            }

            .admission-popup-title {
                font-size: 26px;
            }

            .admission-popup-subtitle {
                font-size: 15px;
            }

            .admission-popup-footer {
                padding: 0 20px 22px;
                flex-wrap: wrap;
            }

            .admission-popup-footer .btn-one {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="modal fade admission-popup-modal" id="admissionAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="admissionAnnouncementLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content admission-popup-content {{ $popup->image_url ? 'is-poster' : 'is-text' }}">
                <button type="button" class="admission-popup-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                @if($popup->image_url)
                    <div class="admission-poster-wrap">
                        @if($popup->button_url)
                            <a href="{{ $popup->button_url }}" target="_blank" rel="noopener" class="admission-poster-link" aria-label="{{ $popup->title }}">
                                <img src="{{ $popup->image_url }}" alt="{{ $popup->image_alt ?: $popup->title }}" class="admission-poster-img">
                            </a>
                        @else
                            <img src="{{ $popup->image_url }}" alt="{{ $popup->image_alt ?: $popup->title }}" class="admission-poster-img">
                        @endif
                    </div>

                    <div class="admission-overlay-actions">
                        @if($popup->button_url)
                            <a href="{{ $popup->button_url }}" target="_blank" rel="noopener" class="btn-one">
                                <span class="txt">{{ $popup->button_text ?: 'Lihat Pengumuman' }}<i class="flaticon-right-arrow-1 arrow1"></i></span>
                            </a>
                        @endif
                        <button type="button" class="admission-ghost-btn" data-dismiss="modal">Nanti Saja</button>
                    </div>
                @else
                    <div class="admission-text-wrap">
                        <p class="admission-popup-kicker">Penerimaan Mahasiswa Baru</p>
                        <h3 class="admission-popup-title" id="admissionAnnouncementLabel">{{ $popup->title }}</h3>
                        @if($popup->subtitle)
                            <p class="admission-popup-subtitle">{{ $popup->subtitle }}</p>
                        @endif
                    </div>

                    <div class="admission-popup-footer">
                        @if($popup->button_url)
                            <a href="{{ $popup->button_url }}" target="_blank" rel="noopener" class="btn-one">
                                <span class="txt">{{ $popup->button_text ?: 'Lihat Pengumuman' }}<i class="flaticon-right-arrow-1 arrow1"></i></span>
                            </a>
                        @endif
                        <button type="button" class="admission-popup-dismiss" data-dismiss="modal">Nanti Saja</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                const key = 'admissionPopupShown';
                if (sessionStorage.getItem(key)) {
                    return;
                }

                setTimeout(function () {
                    $('#admissionAnnouncementModal').modal('show');
                    sessionStorage.setItem(key, '1');
                }, 500);
            });
        </script>
    @endpush
@endif
