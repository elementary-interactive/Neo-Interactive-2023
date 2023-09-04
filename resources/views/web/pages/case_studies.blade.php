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
                                        <div class="partner">{{ $case_study->partner->name }}</div>
                                        <h3>{{ $case_study->title }}</h3>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
