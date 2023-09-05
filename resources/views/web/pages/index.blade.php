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

    @foreach ($page->content as $block)
        @includeFirst(block_template($block), [
            'key' => $block->key(),
            'attributes' => $block->getAttributes(),
        ])
    @endforeach
    
@endsection
