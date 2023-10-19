@extends('web.layouts.black')

@section('title')
    {{ $page->title }}
@endsection

@push('og')
    @include('web.layouts.head.og', [
        'og' => [
            'title' => $book->title,
            'description' => $book->brief,
            'image' => $media->first()?->getUrl('responsive'),
            'type' => 'website',
            'url' => \Request::url(),
        ],
    ])
@endpush

@push('meta')
    @include('web.layouts.head.meta', [
        'meta' => [
            'title' => $book->title,
            'description' => $book->brief,
            // 'image'             => '',
            // 'type'              => 'website',
            // 'url'               => \Request::url()
        ],
    ])
@endpush

@section('body')
    <!-- case studies subpage -->

    <div class="case-study-container book-container default-sub-padding menu-top-margin {{ $book->group->color }}">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route(site()->locale . '.book.index') }}" class="back-link ul"><i class="arrow left"></i>Vissza</a>

                    <h3 class="category">{{ $book->group->label }}</h3>
                    <div class="row">
                        <div class="col-12 col-xl-9">
                            <h1>{{ $book->title }}</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-6 order-2 order-xl-1 basic-text-container">
                            {!! $book->content !!}
                        </div>
                        <div class="col-12 offset-xl-1 col-xl-4 order-1 order-xl-2">
                            <div class="case-study-half-img"
                                style="background-image: url('{{ $book->getFirstMediaUrl(App\Models\Book::MEDIA_COLLECTION, 'responsive') }}')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
