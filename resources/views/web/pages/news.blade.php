@extends('web.layouts.default')

@section('title')
    @push('og')
        @include('web.layouts.head.og', [
            'og' => [
                'title' => $news->title,
                'description' => $news->lead,
                'image' =>
                    $news?->getFirstMediaUrl(App\Models\Course::MEDIA_COLLECTION, 'thumb') ?: $page->og_image,
                'type' => 'website',
                'url' => \Request::url(),
            ],
        ])
    @endpush

    @push('meta')
        @include('web.layouts.head.meta', [
            'meta' => [
                'title' => $news->title,
                'description' => $news->lead,
                // 'image'             => '',
                // 'type'              => 'website',
                // 'url'               => \Request::url()
            ],
        ])
    @endpush

@section('body')

    <!-- news subpage -->

    <div class="news-container default-padding-w menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-7 order-2 order-xl-1">
                    <h1>{{ $news->title }}</h1>
                    <h3>{!! $news->lead !!}</h3>

                    <div class="date">{{ __('Posted at :date', ['date' => $news->published_at->format('Y. n. j. H:i')]) }}
                    </div>

                    <div class="news-content basic-text-container">
                        {!! $news->content !!}
                    </div>

                </div>
                <div class="col-12 col-xl-5 order-1 order-xl-2">
                    <img class="news-img" src="{{ $news?->getFirstMediaUrl(App\Models\News::MEDIA_COLLECTION) }}"
                        alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- more news -->
    @if ($randoms?->count())
        <div class="newsroom-container def-b-margin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2>{{ __('More') }}<span class="yellow">.</span></h2>

                        <div class="newsroom-cards">
                            @foreach ($randoms as $random)
                                <a href="{{ route(site()->locale . '.news.show', ['slug' => $random->slug]) }}"
                                    class="newsroom-card">
                                    <div class="newsroom-card-inner"
                                        style="background-image: url('{{ $random->getFirstMediaUrl(App\Models\News::MEDIA_COLLECTION, 'thumb') }}')">
                                    </div>
                                    <div class="date">
                                        {{ __('Posted at :date', ['date' => $random->published_at->format('Y. n. j. H:i')]) }}
                                    </div>
                                    <h3>{{ $random->title }}</h3>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
