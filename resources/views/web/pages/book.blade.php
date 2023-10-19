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

    <div class="case-study-container default-sub-padding menu-top-margin {{ $book->group->color }}">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route(site()->locale . '.book.index') }}" class="back-link ul"><i class="arrow left"></i>Vissza</a>

                    <h3 class="{{ $book->group->color }}">{{ $book->group->label }}</h3>
                    <div class="row">
                        <div class="col-12 col-xl-9">
                            <h1>{{ $book->title }}</h1>
                        </div>
                    </div>
                    {!! $book->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
