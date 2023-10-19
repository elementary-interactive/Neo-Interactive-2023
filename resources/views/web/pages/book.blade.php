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

    <div class="case-study-container default-sub-padding menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route(site()->locale . '.book.index') }}" class="back-link ul"><i class="arrow left"></i>Vissza</a>

                    <h3 class="yellow">{{ $book->partner?->name }}</h3>
                    <div class="row">
                        <div class="col-12 col-xl-9">
                            <h1>{{ $book->title }}</h1>
                        </div>
                    </div>
                    @if (strlen($book->brief) > 5 && strlen($book->solution) > 5 && strlen($book->result) > 5)

                        <!-- brief -->

                        <div class="row">
                            <div class="col-12 col-xl-6 order-2 order-xl-1">
                                <div class="case-study-row">
                                    <h2>{{ __('Brief') }}</h2>
                                    {!! $book->brief !!}
                                </div>
                                <div class="case-study-row">
                                    <h2>{{ __('Implementation') }}</h2>
                                    <p>{!! $book->solution !!}</p>
                                </div>
                                <div class="case-study-row">
                                    <h2>{{ __('Results') }}</h2>
                                    <p>{!! $book->result !!}</p>
                                </div>
                            </div>
                            <div class="col-12 offset-xl-1 col-xl-4 order-1 order-xl-2">
                                <div class="case-study-half-img"
                                    style="background-image: url('{{ $media[0]->getUrl('responsive') }}')"></div>
                            </div>
                        </div>

                        {{-- <!-- full width img -->
                        @if ($media->count() > 1)
                            <div class="full-w-img" style="background-image: url('{{ $media[1]->getUrl('responsive') }}')">
                            </div>
                        @endif
                        <!-- Megvalósítás -->

                        <div class="row case-study-row">
                            <div class="col-12 col-xl-6">
                                <h2>{{ __('Implementation') }}</h2>
                                <p>{!! $book->solution !!}</p>
                            </div>
                            <div class="col-12 offset-xl-1 col-xl-4">
                                @if ($media->count() > 2)
                                    <div class="case-study-half-img"
                                        style="background-image: url('{{ $media[2]->getUrl('responsive') }}')"></div>
                                @endif
                            </div>
                        </div>

                        <!-- full width img -->
                        @if ($media->count() > 3)
                            <div class="full-w-img" style="background-image: url('{{ $media[3]->getUrl('responsive') }}')">
                            </div>
                        @endif
                        <!-- Eredmények -->

                        <div class="row case-study-row">
                            <div class="col-12 col-xl-6">
                                <h2>{{ __('Results') }}</h2>
                                <p>{!! $book->result !!}</p>
                            </div>
                        </div> --}}
                    @else
                        <div class="row">
                            <div class="col-12 col-xl-6 order-2 order-xl-1">
                                <div class="case-study-row">
                                    {!! $book->old_content !!}
                                </div>                                
                            </div>
                            <div class="col-12 offset-xl-1 col-xl-4 order-1 order-xl-2">
                                @if ($media->count() > 1)
                                    <div class="case-study-half-img"
                                        style="background-image: url('{{ $media[1]->getUrl('responsive') }}')"></div>
                                @endif
                            </div>
                        </div>
                        <!-- full width img -->
                        {{-- @if ($media->count() > 1)
                            @foreach ($media as $index => $medium)
                                @if ($index > 0)
                                <div class="full-w-img"
                                    style="background-image: url('{{ $medium->getUrl('responsive') }}')"></div>
                                @endif
                            @endforeach
                        @endif --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
