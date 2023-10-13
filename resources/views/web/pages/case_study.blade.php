@extends('web.layouts.default')

@section('title')
    {{ $page->title }}
@endsection

@push('og')
    @include('web.layouts.head.og', [
        'og' => [
            'title' => $case_study->title,
            'description' => $case_study->brief,
            'image' => $media->first()?->getUrl('responsive'),
            'type' => 'website',
            'url' => \Request::url(),
        ],
    ])
@endpush

@push('meta')
    @include('web.layouts.head.meta', [
        'meta' => [
            'title' => $case_study->title,
            'description' => $case_study->brief,
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
                    <a href="{{ route(site()->locale . '.case_study.index') }}" class="back-link ul"><i class="arrow left"></i>{{ __('Case Studies') }}</a>

                    <h3 class="yellow">{{ $case_study->partner?->name }}</h3>
                    <div class="row">
                        <div class="col-12 col-xl-9">
                            <h1>{{ $case_study->title }}</h1>
                        </div>
                    </div>
                    @if (strlen($case_study->brief) > 5 && strlen($case_study->solution) > 5 && strlen($case_study->result) > 5)

                        <!-- brief -->

                        <div class="row">
                            <div class="col-12 col-xl-6 order-2 order-xl-1">
                                <div class="case-study-row">
                                    <h2>{{ __('Brief') }}</h2>
                                    {!! $case_study->brief !!}
                                </div>
                                <div class="case-study-row">
                                    <h2>{{ __('Implementation') }}</h2>
                                    <p>{!! $case_study->solution !!}</p>
                                </div>
                                <div class="case-study-row">
                                    <h2>{{ __('Results') }}</h2>
                                    <p>{!! $case_study->result !!}</p>
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
                                <p>{!! $case_study->solution !!}</p>
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
                                <p>{!! $case_study->result !!}</p>
                            </div>
                        </div> --}}
                    @else
                        <div class="row">
                            <div class="col-12 col-xl-6 order-2 order-xl-1">
                                <div class="case-study-row">
                                    {!! $case_study->old_content !!}
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
