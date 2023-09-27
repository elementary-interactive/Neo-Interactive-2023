@extends('web.layouts.default')

@section('title')
    @push('og')
        @include('web.layouts.head.og', [
            'og' => [
                'title' => $course?->title ?: $page->og_title,
                'description' => $course?->description ?: $page->og_description,
                'image' =>
                    $course?->getFirstMediaUrl(App\Models\Course::MEDIA_COLLECTION, 'thumb') ?: $page->og_image,
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

    <!-- courses subpage -->

    <div class="course-container default-padding-w menu-top-margin">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h2>{{ $block->main_title }}</h2>
            <div class="row def-b-margin">
              <div class="col-12 col-xl-9">
                <h1 class="mb-0">{{ $course->title }}</h1>
              </div>
            </div>

            @if ($course->embed)
            <!-- video -->
            <div class="embed-youtube">
            {!! $course->embed !!}
            </div>
            {{-- <div class="embed-youtube">
              <iframe width="560" height="315" src="https://www.youtube.com/embed/2kPJU06DWLA?si=B9ywrQfy-qkzDVge"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
            </div> --}}
            @endif
            <!-- content -->

            <div class="row">
              <div class="col-12 col-xl-9">
                {!! $course->description !!}
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    @if ($randoms?->count())
        <div class="courses-container def-b-margin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2>{{ $block->more_title }}<span class="yellow">.</span></h2>

                        <div class="courses-cards">
                            @foreach ($randoms as $random)
                                <div class="courses-card">
                                    <div class="courses-card-inner"
                                        style="background-image: url('{{ $random->getFirstMediaUrl(App\Models\Course::MEDIA_COLLECTION, 'thumb') }}')">
                                    </div>
                                    <h3>{{ $random->title }}</h3>
                                    <a href="{{ route(site()->locale . '.courses.show', ['slug' => $random->slug]) }}"
                                        class="defbtn"><i class="icon-play"></i>{{ $block->cta_view }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection