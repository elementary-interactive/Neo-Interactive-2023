@extends('web.layouts.default')

@section('title')
    @push('og')
        @include('web.layouts.head.og', [
            'og' => [
                'title' => $case_study->title,
                'description' => $case_study->brief,
                'image' => $media[0]->getUrl('responsive'),
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

    <div class="case-study-container default-padding menu-top-margin">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h3 class="yellow">{{ $case_study->partner->name }}</h3>
            <div class="row">
              <div class="col-12 col-xl-9">
                <h1>{{ $case_study->title }}</h1>
              </div>
            </div>

            <!-- brief -->

            <div class="row case-study-row">
              <div class="col-12 col-xl-6">
                <h2>{{ __('Brief') }}</h2>
                <p>{!! $case_study->brief !!}</p>
              </div>
            </div>

            <!-- full width img -->

            <div class="full-w-img" style="background-image: url('{{ $media[0]->getUrl('responsive') }}')"></div>

            <!-- Megvalósítás -->

            <div class="row case-study-row">
              <div class="col-12 col-xl-6">
                <h2>{{ __('Implementation') }}</h2>
                <p>{!! $case_study->solution !!}</p>
              </div>
              <div class="col-12 offset-xl-1 col-xl-4">
                <div class="case-study-half-img" style="background-image: url('{{ $media[1]->getUrl('responsive') }}')"></div>
              </div>
            </div>

            <!-- full width img -->

            <div class="full-w-img" style="background-image: url('{{ $media[2]->getUrl('responsive') }}')"></div>

            <!-- Eredmények -->

            <div class="row case-study-row">
              <div class="col-12 col-xl-6">
                <h2>{{ __('Results') }}</h2>
                <p>{!! $case_study->result !!}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection