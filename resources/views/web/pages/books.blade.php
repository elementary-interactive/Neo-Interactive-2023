@extends('web.layouts.black')

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
                    <h1>{{ $page->title }}</h1>
                </div>

                <div class="col-12 col-xl-6 pos-rel">
                    <img class="book-img" src="{{ Vite::asset('resources/images/book/book_img.jpg') }}" alt="">
                </div>
            </div>
        </div>

        {{-- Média --}}
        @foreach ($groups as $groupKey => $group)
        <div class="container-fluid main-case-studies-container {{ $group['color'] }}">
            <div class="row">
                <div class="col-12">
                    <h2>{{ $group['label'] }}</h2>

                    <div class="slider">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @if ($books->has($groupKey))
                                    @foreach ($books[$groupKey] as $book)
                                    <div class="swiper-slide">
                                        <a href="{{ route(site()->locale . '.book.show', ['slug' => $book->slug]) }}"
                                            class="swiper-slide-inner"
                                            style="background-image: url('{{ $book->getFirstMediaUrl(App\Models\Book::MEDIA_COLLECTION, 'responsive') }}')">
                                            <div class="partner">{{ $group['label'] }}</div>
                                            <h3>{{ $book->title }}</h3>
                                        </a>
                                    </div>
                                    @endforeach
                                @endif
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
        @endforeach
    </div>
@endsection
