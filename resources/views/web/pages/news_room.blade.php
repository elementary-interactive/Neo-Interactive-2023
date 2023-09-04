@extends('web.layouts.default')

@section('title')
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
    <!-- newsroom -->

    <div class="newsroom-container default-padding menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $page->title }}<span class="yellow">.</span></h1>

                    <div class="row">
                        <div class="col-12 col-xl-5 newsroom-filter">
                          <div class="filter-label">{{ $form->title }}</div>
                          <div class="dropdown">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              {{ $form->date_label }}
                            </button> 
                            <ul class="dropdown-menu">
                              @foreach ($years as $year)
                                <li><a class="dropdown-item" href="{{ route(site()->locale . '.news.index', ['year' => $year->year]) }}">{{ $year->year }}</a></li>
                              @endforeach
                            </ul>
                          </div>
                          <div class="dropdown">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              {{ $form->partner_label }}
                            </button>
                            <ul class="dropdown-menu">
                              @foreach ($partners as $partner)
                                <li><a class="dropdown-item" href="{{ route(site()->locale . '.news.index', ['partner' => $partner->slug]) }}">{{ $partner->name }}</a></li>
                              @endforeach
                            </ul>
                          </div>
                          <div class="dropdown">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              {{ $form->tag_label }}
                            </button>
                            <ul class="dropdown-menu">
                              @foreach ($tags as $tag)
                                <li><a class="dropdown-item" href="{{ route(site()->locale . '.news.index', ['filter' => $tag->getTranslation('slug', site()->locale)]) }}">{{ $tag->getTranslation('name', site()->locale) }}</a></li>
                              @endforeach
                            </ul>
                          </div>
                        </div>
                      </div>

                    @if ($news?->count())
                        <div class="newsroom-cards">
                          @foreach ($news as $article)
                            <a href="{{ route(site()->locale . '.news.show', ['slug' => $article->slug]) }}" class="newsroom-card">
                                <div class="newsroom-card-inner" style="background-image: url('{{ $article->getFirstMediaUrl(App\Models\News::MEDIA_COLLECTION, 'thumb') }}')">
                                </div>
                                <div class="date">{{ __('Posted at :date', ['date' => $article->published_at->format('Y. n. j. H:i') ]) }}</div>
                                <h3>{{ $article->title }}</h3>
                            </a>
                           @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
