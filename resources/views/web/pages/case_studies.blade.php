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
    <!-- case studies -->


    <div class="case-studies-container default-padding menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $page->title }}<span class="yellow">.</span></h1>
                    @if ($filters?->count())
                        <div class="case-studies-filter">
                            @foreach ($filters as $filter)
                                @if ($filter->getTranslation('slug', site()->locale) == request()->get('filter'))
                                    <a href="{{ route(site()->locale . '.case_study.index') }}"
                                        class="ul active">{{ $filter->getTranslation('name', site()->locale) }}</a>
                                @else
                                    <a href="{{ route(site()->locale . '.case_study.index', ['filter' => $filter->getTranslation('slug', site()->locale)]) }}"
                                        class="ul">{{ $filter->getTranslation('name', site()->locale) }}</a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    @if ($case_studies?->count())
                        <div class="case-studies-cards">
                            @foreach ($case_studies as $case_study)
                                <a href="{{ route(site()->locale . '.case_study.show', ['slug' => $case_study->slug]) }}"
                                    class="case-studies-card">
                                    <div class="case-studies-card-inner"
                                        style="background-image: url('{{ $case_study->getFirstMediaUrl(App\Models\CaseStudy::MEDIA_COLLECTION, 'thumb') }}')">
                                        <div class="partner">{{ $case_study->partner?->name }}</div>
                                        <h3>{{ $case_study->title }}</h3>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="more-btn-container text-center def-t-margin">
                            <div class="defbtn"><i class="icon-arrow-right"></i>További munkáink ...</div>
                        </div>
                        {{-- <div class="ajax-loading def-t-margin">
                            <div class="square-container">
                                <div class="square-1 square"></div>
                                <div class="square-2 square"></div>
                                <div class="square-3 square"></div>
                            </div>
                        </div> --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        var __url = "{{ route(site()->locale . '.case_study.load') }}";
        var __query = "{{ parse_url("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", PHP_URL_QUERY) }}";
        var page = 0; //track user scroll as page number, right now page number is 1

        // load_more(page); //initial content load
        $(document).ready(function() {
            $('.ajax-loading').hide();

            $(window).scroll(function() { //detect page scroll
                if ($(window).scrollTop() + $(window).height() >= $(document)
                    .height() - 100) { //if user scrolled from top to bottom of the page
                    if ($('.ajax-loading').is(":hidden"))
                    {
                        page += 9; //page number increment

                        load_more(page); //load content   
                    }
                }
            });
        });

        function load_more(page) {
            $.ajax({
                    url: __url + '?' + ((__query.length) ? __query + '&' : '') + 'offset=' + page,
                    type: "get",
                    datatype: "html",
                    beforeSend: function() {
                        $('.ajax-loading').show();
                    }
                })
                .done(function(data, status) {
                    if (data.length > 0) {
                        $.each(data, function(index, cs) {
                            $(".case-studies-cards").append('<a href="' + cs.href + '"' +
                                'class="case-studies-card">' +
                                '<div class="case-studies-card-inner"' +
                                'style="background-image: url(\'' + cs.iurl + '\')">' +
                                '<div class="partner">' + cs.name + '</div>' +
                                '<h3>' + cs.ttle + '</h3>' +
                                '</div>' +
                                '</a>'); //- Append article
                        });
                    }
                    window.setTimeout(function() {
                        $('.ajax-loading').hide(); //hide loading animation once data is received
                    }, 2000);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    $('.ajax-loading').hide();
                    console.log(thrownError);
                });
        }
    </script>
@endpush
