@extends('web.layouts.default')

@section('title')
    {{ $page->title }}
@endsection

@push('og')
    @include('web.layouts.head.og', [
        'og' => [
            'title' => $page->og_title,
            'description' => $page->og_description,
            'image' => $page->og_image,
            'type' => 'website',
            'url' => \Request::url(),
        ],
    ])
@endpush

@push('meta')
    @include('web.layouts.head.meta', [
        'meta' => [
            'title' => $page->og_title,
            'description' => $page->og_description,
            // 'image'             => '',
            // 'type'              => 'website',
            // 'url'               => \Request::url()
        ],
    ])
@endpush

@section('body')
    <!-- case studies -->


    <div class="books-container default-padding menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-6">
                    <h1>Digitális Média Tények Könyve</h1>
                    <div class="book-year">2023</div>
                </div>

                <div class="col-12 col-xl-6 pos-rel">
                    <img class="book-img" src="{{ Vite::asset('resources/images/book/book_img.jpg') }}" alt="">
                </div>
            </div>
        </div>

        {{-- Média --}}

        <div class="container-fluid main-case-studies-container blue-ver">
            <div class="row">
                <div class="col-12">
                    <h2>Média</h2>

                    <div class="slider">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_01.png')">
                                        <div class="partner">AMC Magyarország</div>
                                        <h3>Vadon János tovább hódít a Spektrum birodalmában!</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_02.png')">
                                        <div class="partner">dr. Oetker</div>
                                        <h3>Süsd meg, ez<br>nagyon jó lett!</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_03.png')">
                                        <div class="partner">dr. Oetker</div>
                                        <h3>Süsd meg, ez<br>nagyon jó lett!</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_04.png')">
                                        <div class="partner">dr. Oetker</div>
                                        <h3>Süsd meg, ez<br>nagyon jó lett!</h3>
                                    </div>
                                </div>                                
                            </div>

                            <!-- scrollbar -->
                            <div class="scroll-label">SCROLL TO EXPLORE</div>
                            <div class="swiper-scrollbar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Marketing --}}

        <div class="container-fluid main-case-studies-container orange-ver">
            <div class="row">
                <div class="col-12">
                    <h2>Marketing</h2>

                    <div class="slider">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_01.png')">
                                        <div class="partner">AMC Magyarország</div>
                                        <h3>Vadon János tovább hódít a Spektrum birodalmában!</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_02.png')">
                                        <div class="partner">dr. Oetker</div>
                                        <h3>Süsd meg, ez<br>nagyon jó lett!</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_03.png')">
                                        <div class="partner">dr. Oetker</div>
                                        <h3>Süsd meg, ez<br>nagyon jó lett!</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_04.png')">
                                        <div class="partner">dr. Oetker</div>
                                        <h3>Süsd meg, ez<br>nagyon jó lett!</h3>
                                    </div>
                                </div>                                
                            </div>

                            <!-- scrollbar -->
                            <div class="scroll-label">SCROLL TO EXPLORE</div>
                            <div class="swiper-scrollbar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         {{-- Fogyasztók & Trendek --}}

         <div class="container-fluid main-case-studies-container purple-ver">
            <div class="row">
                <div class="col-12">
                    <h2>Fogyasztók & Trendek</h2>

                    <div class="slider">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_01.png')">
                                        <div class="partner">AMC Magyarország</div>
                                        <h3>Vadon János tovább hódít a Spektrum birodalmában!</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_02.png')">
                                        <div class="partner">dr. Oetker</div>
                                        <h3>Süsd meg, ez<br>nagyon jó lett!</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_03.png')">
                                        <div class="partner">dr. Oetker</div>
                                        <h3>Süsd meg, ez<br>nagyon jó lett!</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_04.png')">
                                        <div class="partner">dr. Oetker</div>
                                        <h3>Süsd meg, ez<br>nagyon jó lett!</h3>
                                    </div>
                                </div>                                
                            </div>

                            <!-- scrollbar -->
                            <div class="scroll-label">SCROLL TO EXPLORE</div>
                            <div class="swiper-scrollbar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         {{-- Fogyasztók & Trendek --}}

         <div class="container-fluid main-case-studies-container yellow-ver">
            <div class="row">
                <div class="col-12">
                    <h2>Fogyasztók & Trendek</h2>

                    <div class="slider">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_01.png')">
                                        <div class="partner">AMC Magyarország</div>
                                        <h3>Vadon János tovább hódít a Spektrum birodalmában!</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_02.png')">
                                        <div class="partner">dr. Oetker</div>
                                        <h3>Süsd meg, ez<br>nagyon jó lett!</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_03.png')">
                                        <div class="partner">dr. Oetker</div>
                                        <h3>Süsd meg, ez<br>nagyon jó lett!</h3>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="swiper-slide-inner"
                                        style="background-image: url('images/main/cs_04.png')">
                                        <div class="partner">dr. Oetker</div>
                                        <h3>Süsd meg, ez<br>nagyon jó lett!</h3>
                                    </div>
                                </div>                                
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
@endsection
