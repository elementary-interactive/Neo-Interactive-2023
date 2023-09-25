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

@section('body')
    <!-- error page -->

    <div class="error-page default-padding menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>404<span class="yellow">.</span></h1>
                    <h3>The content you're looking for can't be found. Sorry about that.</h3>
                    <a href="" class="defbtn"><i class="icon-arrow-left"></i>go to homepage</a>
                </div>
            </div>
        </div>
    </div>
@endsection
