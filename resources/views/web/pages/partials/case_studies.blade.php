@if ($case_studies?->count())
    <!-- case studies -->

    <div class="main-case-studies-container">
        <div class="case-studies-bg"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2>{!! $attributes['title'] !!}<span class="yellow">.</span></h2>

                    <div class="slider">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($case_studies as $case_study)
                                    <div class="swiper-slide">
                                        <a href="{{ route(site()->locale . '.case_study.show', ['slug' => $case_study->slug]) }}"
                                            class="swiper-slide-inner"
                                            style="background-image: url('{{ $case_study->getFirstMediaUrl(App\Models\CaseStudy::MEDIA_COLLECTION, 'responsive') }}')">
                                            <div class="partner">{{ $case_study->partner?->name }}</div>
                                            <h3>{{ $case_study->title }}</h3>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <!-- scrollbar -->                            
                            <div class="swiper-scrollbar">
                                <div class="scroll-label">{{ __('SCROLL TO EXPLORE') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
