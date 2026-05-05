<!--Start Gallery Area-->
<section class="gallery-area" id="{{ $section->slug }}">
    <div class="container">
        <div class="sec-title text-center">
            @if($section->subtitle)
                <div class="sub-title">
                    <p>{{ $section->subtitle }}</p>
                </div>
            @endif
            <h2>{{ $section->title }}</h2>
        </div>

        <div class="row masonary-layout">
            @forelse($section->items as $item)
                <div class="{{ $item->col_classes }}">
                    <div class="single-gallery-item">
                        <div class="img-holder">
                            <img src="{{ $item->image_url }}" alt="{{ $item->image_alt ?? $item->title }}">
                            <div class="overlay-button">
                                <a href="{{ $item->image_url }}">
                                    <span class="{{ $item->icon_class }} {{ $item->icon_color_class }}"></span>
                                </a>
                            </div>
                        </div>
                        <div class="title-holder">
                            @if($item->category_label)
                                <p>{{ $item->category_label }}</p>
                            @endif
                            <h3><a href="#">{{ $item->title }}</a></h3>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Belum ada item galeri.</p>
                </div>
            @endforelse
        </div>

        @if($section->button_text && $section->button_url)
            <div class="row">
                <div class="col-xl-12">
                    <div class="gallery_viewmore_button text-center">
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
<!--End Gallery Area-->
