<!--Start Video Gallery Area-->
<section class="video-gallery-area" id="{{ $section->slug }}" @if($section->background_image_url)
style="background-image: url({{ $section->background_image_url }});" @endif>
    <div class="container-fullwidth">
        <div class="row">
            <div class="col-xl-12">
                <div class="video-holder-box text-center">
                    @php
                        $video = $section->items->first();
                    @endphp

                    @if($video)
                        <div class="icon wow zoomIn" data-wow-delay="{{ $video->animation_delay_ms }}ms"
                            data-wow-duration="1500ms">
                            <a class="video-popup" title="{{ $video->title }}" href="{{ $video->video_url }}">
                                <span class="{{ $video->play_icon_class }}"></span>
                            </a>
                        </div>
                    @endif

                    <h2>{{ $section->title }}</h2>

                    @if($section->subtitle)
                        <div class="mt-2">
                            <p class="mb-0">{{ $section->subtitle }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Jika ingin render lebih dari satu video sebagai daftar tombol kecil, aktifkan blok di bawah --}}
        {{--
        @if($section->items->count() > 1)
        <div class="row justify-content-center mt-4">
            @foreach($section->items->skip(1) as $it)
            <div class="col-auto">
                <a class="video-popup d-inline-flex align-items-center" title="{{ $it->title }}"
                    href="{{ $it->video_url }}">
                    <span class="{{ $it->play_icon_class }}"></span>
                    <span class="ms-2">{{ $it->title }}</span>
                </a>
            </div>
            @endforeach
        </div>
        @endif
        --}}
    </div>
</section>
<!--End Video Gallery Area-->
