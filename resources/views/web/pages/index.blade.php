@extends('web.layouts.index')

{{-- @section('title')
@push('og')
    @include('web.layouts.head.og', [
        'og' => [
            'title' => $product->name,
            'description' => $product->description,
            'image' => '',
            'type' => 'website',
            'url' => \Request::url(),
        ],
    ])
@endpush

@push('meta')
    @include('web.layouts.head.meta', [
        'meta' => [
            'title' => $product->name,
            'description' => $product->description,
            // 'image'             => '',
            // 'type'              => 'website',
            // 'url'               => \Request::url()
        ],
    ])
@endpush

@push('breadcrumb')
    @include('components.breadcrumb', [
        'path' => $path,
        'brand' => isset($brand) ? $brand : null,
        'is_product' => true,
    ])
@endpush --}}

@section('index')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>
                    Neo aims <br class="d-xl-none">to propel<br>
                    your business <br class="d-xl-none">forward<span class="yellow">.</span>
                </h1>
                <p class="subline">
                    Established in 2002.<br>
                    Present in 27 countries worldwide.
                </p>
                <a href="" class="defbtn"><i class="icon-arrow-right"></i>How we can help you</a>
            </div>
        </div>
    </div>

    <div class="scroll-down">
        <p><img src="{{ Vite::asset('resources/images/scroll-mouse.svg') }}" alt="SCROLL to explore"> SCROLL to explore</p>
    </div>
@endsection

@section('body')
    <div class="main-testimony-container">
        <div class="testimony-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2>We are neo<span class="yellow">.</span><br>
                            A full-service communication
                            and media agency with a digital focus.</h2>
                        <div class="testimony-btn">
                            <a href="" class="defbtn"><i class="icon-arrow-right"></i>Actionable knowledge</a>
                        </div>
                        <div>
                            <a href="" class="defbtn open-popup"><i class="icon-arrow-right"></i>our mission</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="showreel" style="background-image: url('{{ Vite::asset('resources/images/main/showreel.png') }}')">
            <a href="" class="defbtn white"><i class="icon-play"></i>view our showreel</a>
        </div>
    </div>
    @if ($partners?->count())
        <!-- partners -->

        <div class="main-partners-container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="partners-items">
                            @foreach ($partners as $partner)
                                <div class="partners-item">
                                    {{ $partner->getFirstMedia(App\Models\Partner::MEDIA_COLLECTION) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($case_studies?->count())
        <!-- case studies -->

        <div class="main-case-studies-container">
            <div class="case-studies-bg"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2>Case studies<span class="yellow">.</span></h2>

                        <div class="slider">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($case_studies as $case_study)
                                    <div class="swiper-slide">
                                       <a href="{{ route(site()->locale.'.case_study.show', ['slug' => $case_study->slug])}}" class="swiper-slide-inner"
                                            style="background-image: url('{{ $case_study->getFirstMediaUrl(App\Models\CaseStudy::MEDIA_COLLECTION, 'thumb')}}')">
                                            <div class="partner">{{ $case_study->partner->name }}</div>
                                            <h3>{{ $case_study->title }}</h3>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- scrollbar -->
                                <div class="scroll-label">SCROLL TO EXPLORE</div>
                                <div class="swiper-scrollbar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
