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
    <!-- courses -->

    <div class="courses-container default-padding menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $block->title }}<span class="yellow">.</span></h1>

                    <div class="row">
                        <div class="col-12 col-xl-5 courses-desc">
                            <p>{!! $block->intro !!}</p>
                        </div>
                    </div>


                    <div class="courses-cards">
                        @forelse ($courses as $index => $course)
                            @if ($index == 0 && !$course->registration_open)
                                <div class="courses-card">
                                    <div class="courses-card-inner"
                                        style="background-image: url('{{ Storage::url($block->empty_image) }}')">
                                    </div>
                                    <h3>{{ $block->empty_title }}</h3>
                                    <a href="{{ route(site()->locale . '.courses.show') }}" class="defbtn hover"><i
                                            class="icon-arrow-right"></i>{{ $block->cta_title }}</a>
                                </div>
                            @else
                                <div class="courses-card">
                                    <div class="courses-card-inner"
                                        style="background-image: url('{{ $course->getFirstMediaUrl(App\Models\Course::MEDIA_COLLECTION, 'thumb') }}')">
                                        @if ($course->start_at)
                                            <div class="date">
                                                {{ str_replace('##datum##', $course->start_at->format('Y. n. j. H:i'), $block->stream_title) }}
                                            </div>
                                        @endif
                                    </div>
                                    <h3>{{ $course->title }}</h3>
                                    @if ($course->registration_open)
                                        <a href="{{ route(site()->locale . '.courses.show', ['slug' => $course->slug]) }}"
                                            class="defbtn hover"><i class="icon-arrow-right"></i>{{ $block->cta_title }}</a>
                                    @else
                                        <a href="{{ route(site()->locale . '.courses.show', ['slug' => $course->slug]) }}"
                                            class="defbtn"><i class="icon-play"></i>{{ $block->cta_view }}</a>
                                    @endif
                                </div>
                            @endif
                        @empty
                            <div class="courses-card">
                                <div class="courses-card-inner"
                                    style="background-image: url('{{ Storage::url($block->empty_image) }}')">
                                </div>
                                <h3>{{ $block->empty_title }}</h3>
                                <a href="{{ route(site()->locale . '.courses.show') }}" class="defbtn hover"><i
                                        class="icon-arrow-right"></i>{{ $block->cta_empty_title }}</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
