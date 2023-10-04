@extends('web.layouts.index')

@section('title')
    {{ $page->title }}
@endsection

@push('og')
    @include('web.layouts.head.og', [
        'og' => [
            'title' => $page->title,
            'description' => $page->lead,
            'image' => $page->og_image,
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

@section('index')
    @include('web.pages.partials.'.site()->locale.'_index')
@endsection

@section('body')

    @foreach ($page->content as $block)
        @includeFirst(block_template($block), [
            'key' => $block->key(),
            'attributes' => $block->getAttributes(),
        ])
    @endforeach
    
@endsection
