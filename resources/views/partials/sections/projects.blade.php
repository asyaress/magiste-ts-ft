<!--Start Research & Thesis Area-->
<section class="project-style3-area" id="{{ $section->slug }}">
    <div class="container">
        <div class="sec-title text-center">
            @if($section->subtitle)
                <div class="sub-title">
                    <p>{{ $section->subtitle }}</p>
                </div>
            @endif
            <h2>{{ $section->title }}</h2>
        </div>

        <div class="row">
            @forelse($section->topics as $topic)
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="single-project-style1 wow fadeInUp" data-wow-delay="{{ $topic->animation_delay_ms }}ms"
                        data-wow-duration="1500ms">
                        <div class="img-holder">
                            <div class="icon {{ $topic->bg_color_class }}">
                                <span class="{{ $topic->icon_class }}"></span>
                            </div>
                            <div class="inner">
                                <img src="{{ $topic->image_url }}" alt="{{ $topic->image_alt ?? $topic->title }}">
                                <div class="zoom-button">
                                    <a class="lightbox-image" data-fancybox="gallery"
                                        href="{{ $topic->gallery_image_url }}">
                                        <i class="flaticon-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="title-holder">
                            <h4><a href="#">{{ $topic->title }}</a></h4>
                            @if($topic->description)
                                <p>{{ $topic->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Belum ada topik riset yang aktif.</p>
                </div>
            @endforelse
        </div>

        @if($section->button_url && $section->button_text)
            <div class="row">
                <div class="col-xl-12">
                    <div class="project-style3_viewmore_button text-center">
                        <a class="btn-one" href="{{ $section->button_url }}">
                            <span class="txt">
                                {{ $section->button_text }}
                                <i class="flaticon-right-arrow-1 arrow1"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<!--End Research & Thesis Area-->
