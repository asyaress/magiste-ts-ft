<!--Start Blog Style1 Area-->
<section class="blog-style1-area" id="{{ $section->slug }}">
    <div class="container">
        <div class="sec-title text-center">
            @if(!empty($section->subtitle))
                <div class="sub-title">
                    <p>{{ $section->subtitle }}</p>
                </div>
            @endif
            <h2>{{ $section->title }}</h2>
        </div>

        <div class="row text-right-rtl">
            @forelse($section->posts->take(3) as $post)
                <div class="col-xl-4 col-lg-4">
                    <div class="single-blog-style1 wow fadeInUp" data-wow-duration="{{ $post->animation_duration_ms }}ms">
                        <div class="img-holder">
                            <div class="inner">
                                <img src="{{ $post->image_url ?? asset('assets/images/blog/blog-v1-1.jpg') }}"
                                    alt="{{ $post->image_alt ?? $post->title }}">
                                <div class="overlay-icon">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        <span class="{{ $post->overlay_icon_class ?: 'flaticon-plus' }}"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="text-holder">
                            <ul class="meta-info">
                                <li>
                                    <i class="flaticon-calendar"></i>
                                    {{ optional($post->published_at)->format('F d, Y') }}
                                </li>
                                <li>
                                    <i class="flaticon-message"></i>{{ sprintf('%02d', $post->comment_count) }}
                                </li>
                            </ul>
                            <h3 class="blog-title">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <div class="text">
                                <p>{{ $post->excerpt }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Belum ada artikel.</p>
                </div>
            @endforelse
        </div>

        @if($section->button_text && $section->button_url)
            <div class="row">
                <div class="col-xl-12">
                    <div class="blog-style1_viewmore_button text-center">
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
<!--End Blog Style1 Area-->
