@extends('web.layouts.default')

@section('title')
    {{ $page->title }}
@endsection

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

    <div class="course-registration-container default-padding-w menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2>{{ $block->main_title }}<span class="yellow">.</span></h2>
                    <div class="row def-b-margin">
                        <div class="col-12 col-xl-9">
                            <h1 class="mb-0">{{ $course?->title ?: $block->title }}</h1>
                        </div>
                    </div>

                    <div class="row">

                        <!-- description -->

                        <div class="col-12 col-xl-6">
                            <div class="course-registration-desc">
                                {!! $course?->description ?: $block->description !!}
                            </div>
                        </div>

                        <!-- reg form -->

                        <div class="col-12 col-xl-6">
                            <div class="registration-form">
                                <h2>{{ $form->title }}<span class="yellow">.</span></h2>
                                <form action="{{ route(site()->locale . '.courses.store', ['slug' => $course?->slug]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>{{ $form->name_label }}</label>
                                        <input placeholder="{{ $form->name_placeholder }}" name="name" type="text"
                                            value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror">
                                    </div>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label>{{ $form->phone_label }}</label>
                                        <input placeholder="{{ $form->phone_placeholder }}" name="phone" type="phone"
                                            value="{{ old('phone') }}"
                                            class="form-control @error('phone') is-invalid @enderror">
                                    </div>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label>{{ $form->email_label }}</label>
                                        <input placeholder="{{ $form->email_placeholder }}" name="email" type="email"
                                            value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="privacy" value="1"
                                                id="legal" v-model="isArial">
                                            <label class="form-check-label" for="legal">{{ $form->privacy_label }} <a
                                                    href="{{ route(site()->locale . '.privacy-policy') }}"
                                                    target="_blank" class="pp ul">{{ __('Privacy Policy') }}</a>
                                            </label>
                                        </div>
                                    </div>
                                    @error('privacy')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="defbtn"><i
                                            class="icon-arrow-right"></i>{{ $form->submit_label }}</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- more courses -->
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
    </section>
@endsection
