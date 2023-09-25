@extends('web.layouts.default')

@section('title')
    @push('og')
        @include('web.layouts.head.og', [
            'og' => [
                'title' => $job?->title ?: $page->og_title,
                'description' => $job?->description ?: $page->og_description,
                'image' => $page->og_image,
                'type' => 'website',
                'url' => \Request::url(),
            ],
        ])
    @endpush

    @push('meta')
        @include('web.layouts.head.meta', [
            'meta' => [
                'title' => $job?->title ?: $page->og_title,
                'description' => $job?->description ?: $page->og_description,
                // 'image'             => '',
                // 'type'              => 'website',
                // 'url'               => \Request::url()
            ],
        ])
    @endpush

@section('body')
    <!-- carrer subpage -->

    <div class="carrer-container default-padding-w menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2>{{ __('We are looking for:') }}</h2>
                    <div class="row def-b-margin">
                        <div class="col-12 col-xl-9">
                            <h1 class="mb-0">{{ $job->title }}</h1>
                        </div>
                    </div>

                    <div class="row">

                        <!-- description -->

                        <div class="col-12 col-xl-6">
                            <div class="carrer-registration-desc basic-text-container">
                                {!! $job->description !!}
                            </div>
                        </div>

                        <!-- reg form -->

                        <div class="col-12 col-xl-6">
                            <div class="registration-form">
                                <h2>{{ $form->title }}<span class="yellow">.</span></h2>
                                <form action="{{ route(site()->locale . '.apply.store', ['slug' => $job?->slug]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>{{ $form->name_label }}</label>
                                        <input placeholder="{{ $form->name_placeholder }}" name="name" type="text" value="{{ old('name') }}"
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
                                        <input placeholder="{{ $form->email_placeholder }}" name="email" type="email" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="file-upload" class="custom-file-upload mb-0">
                                            <a class="defbtn"><i class="icon-arrow-right"></i>{{ $form->file_label }}</a>
                                        </label>
                                        <input id="file-upload" name="file" class="form-control-file d-none"
                                            type="file">
                                    </div>
                                    @error('file')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="privacy" value="1"
                                                id="legal" v-model="isArial">
                                            <label class="form-check-label" for="legal">{!! str_replace('>>', '<a href="'.route(site()->locale . '.privacy-policy').'" target="_blank" class="pp ul">', str_replace('<<', '</a>', $form->privacy_label)) !!}</label>
                                                {{-- <a
                                                    href="{{ route(site()->locale . '.privacy-policy') }}"
                                                    class="pp ul">{{ __('Privacy Policy') }}</a> --}}
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
@endsection
