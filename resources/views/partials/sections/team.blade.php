<!--Start Team Style1 Area-->
<section class="team-style1-area" id="{{ $section->slug }}">
    @php
        $teachers = collect($section->teachers ?? []);
        $previewTeachers = $teachers->take(4);
    @endphp

    <div class="container">
        <div class="sec-title text-center">
            @if($section->subtitle)
                <div class="sub-title">
                    <p>{{ $section->subtitle }}</p>
                </div>
            @endif
            <h2>{{ $section->title }}</h2>
        </div>

        <div class="row text-right-rtl">
            @forelse($previewTeachers as $t)
                <div class="{{ $t->col_classes }} {{ $t->wow_animation_class }}"
                    data-wow-delay="{{ $t->animation_delay_ms }}ms" data-wow-duration="{{ $t->animation_duration_ms }}ms">
                    <div class="single-team-item">
                        <div class="img-holder">
                            <div class="inner">
                                <img src="{{ $t->photo_url ?? asset('assets/images/team/team-v1-4.jpg') }}"
                                    alt="{{ $t->photo_alt ?? $t->name }}">
                            </div>
                            <div class="overlay-icon">
                                <a href="{{ $t->profile_url ?? '#' }}"><span class="flaticon-plus"></span></a>
                            </div>
                            <div class="social-icon">
                                <ul>
                                    @if($t->linkedin_url)
                                        <li><a href="{{ $t->linkedin_url }}" class="linkedin" aria-label="LinkedIn"
                                                target="_blank" rel="noopener">
                                                <i class="fa fa-linkedin"></i></a></li>
                                    @endif
                                    @if($t->scholar_url)
                                        <li><a href="{{ $t->scholar_url }}" class="scholar" aria-label="Google Scholar"
                                                target="_blank" rel="noopener">
                                                <i class="fa fa-google"></i></a></li>
                                    @endif
                                    @if($t->website_url)
                                        <li><a href="{{ $t->website_url }}" class="web" aria-label="Profil Web" target="_blank"
                                                rel="noopener">
                                                <i class="fa fa-globe"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="title-holder">
                            <h3>
                                <a href="{{ $t->profile_url ?? '#' }}">{{ $t->name }}</a>
                            </h3>
                            @if($t->tagline)
                                <p>{{ $t->tagline }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Belum ada data pengajar.</p>
                </div>
            @endforelse
        </div>

        @if($teachers->count() > 4)
            <div class="row">
                <div class="col-12 text-center mt-4">
                    <a class="btn-one" href="{{ route('teams.index') }}">
                        <span class="txt">Lihat Selengkapnya <i class="flaticon-right-arrow-1 arrow1"></i></span>
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>
<!--End Team Style1 Area-->
