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
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ $form->date_label }}
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($years as $year)
                                        <li><a class="dropdown-item"
                                                href="{{ route(site()->locale . '.news.index', ['year' => $year->year]) }}">{{ $year->year }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ $form->partner_label }}
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($partners as $partner)
                                        <li><a class="dropdown-item"
                                                href="{{ route(site()->locale . '.news.index', ['partner' => $partner->slug]) }}">{{ $partner?->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ $form->tag_label }}
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($tags as $tag)
                                        <li><a class="dropdown-item"
                                                href="{{ route(site()->locale . '.news.index', ['filter' => $tag->getTranslation('slug', site()->locale)]) }}">{{ $tag->getTranslation('name', site()->locale) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    @if ($news?->count())
                        <div class="newsroom-cards">
                            @foreach ($news as $article)
                                <a href="{{ route(site()->locale . '.news.show', ['slug' => $article->slug]) }}"
                                    class="newsroom-card">
                                    <div class="newsroom-card-inner"
                                        style="background-image: url('{{ $article->getFirstMediaUrl(App\Models\News::MEDIA_COLLECTION, 'thumb') }}')">
                                    </div>
                                    <div class="date">
                                        {{ __('Posted at :date', ['date' => $article->published_at->format('Y. n. j. H:i')]) }}
                                    </div>
                                    <h3>{{ $article->title }}</h3>
                                </a>
                            @endforeach
                        </div>
                        <div class="more-btn-container text-center def-t-margin">
                            <div class="defbtn" id="more-loading"><i class="icon-arrow-right"></i>{{ __('More news...') }}</div>
                        </div>
                        {{--
                            
                        <div class="ajax-loading def-t-margin">
                            <div class="square-container">
                                <div class="square-1 square"></div>
                                <div class="square-2 square"></div>
                                <div class="square-3 square"></div>
                            </div>
                        </div>
                        
                        --}}
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        var __url = "{{ route(site()->locale . '.news.load') }}";
        var __query = "{{ parse_url("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", PHP_URL_QUERY) }}";
        var page = 0; //track user scroll as page number, right now page number is 1

        // load_more(page); //initial content load
        $(document).ready(function() {
            $('#more-loading').click(function() { //detect page scroll
                if ($('#more-loading').is(":enabled"))
                {
                    page += 9; //page number increment
                    load_more(page); //load content   
                }
            });
        });

        function load_more(page) {
            $.ajax({
                    url: __url + '?' + ((__query.length) ? __query + '&' : '') + 'offset=' + page,
                    type: "get",
                    datatype: "html",
                    beforeSend: function() {
                        $('#more-loading').prop('disabled', true);
                    }
                })
                .done(function(data, status) {
                    if (data.length > 0) {
                        $.each(data, function(index, article) {
                            $(".newsroom-cards").append('<a href="' + article.href + '"' +
                                'class="newsroom-card">' +
                                '<div class="newsroom-card-inner"' +
                                'style="background-image: url(\'' + article.iurl + '\')">' +
                                '</div>' +
                                '<div class="date">' + article.date + '</div>' +
                                '<h3>' + article.ttle + '</h3></a>'); //- Append article
                        });
                    }
                    // window.setTimeout(function() {
                        $('#more-loading').prop('disabled', false); //hide loading animation once data is received
                    // }, 2000);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    $('#more-loading').prop('disabled', false);
                    console.log(thrownError);
                });
        }
    </script>
@endpush
