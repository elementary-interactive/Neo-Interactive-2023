@extends('web.layouts.default')

@section('title')
    @push('og')
        @include('web.layouts.head.og', [
            'og' => [
                'title' => $page->title,
                'description' => $page->lead,
                'image' =>
                    $page?->getFirstMediaUrl(App\Models\Course::MEDIA_COLLECTION, 'thumb') ?: $page->og_image,
                'type' => 'website',
                'url' => \Request::url(),
            ],
        ])
    @endpush

    @push('meta')
        @include('web.layouts.head.meta', [
            'meta' => [
                'title' => $page->title,
                'description' => $page->lead,
                // 'image'             => '',
                // 'type'              => 'website',
                // 'url'               => \Request::url()
            ],
        ])
    @endpush

@section('body')

    <!-- page subpage -->

    <div class="page-container default-padding-w menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-7 order-2 order-xl-1">
                    <h1>{{ $page->title }}</h1>
                </div>
            </div>
        </div>
    </div>
    {{ dd($page) }}
@endsection
