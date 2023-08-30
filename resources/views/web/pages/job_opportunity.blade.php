@extends('web.layouts.default')

@section('title')
    @push('og')
        @include('web.layouts.head.og', [
            'og' => [
                'title' => $job->title,
                'description' => $job->description,
                'type' => 'website',
                'url' => \Request::url(),
            ],
        ])
    @endpush

    @push('meta')
        @include('web.layouts.head.meta', [
            'meta' => [
                'title' => $job->title,
                'description' => $job->description,
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
                    <h2>We are looking for:</h2>
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
                                <h2>Apply now<span class="yellow">.</span></h2>
                                <form action="">
                                    <div class="form-group">
                                        <label>Your name</label>
                                        <input placeholder="What can we call you?" name="name" type="text"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Your email address</label>
                                        <input placeholder="Where we can reply back to" name="email" type="email"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="file-upload" class="custom-file-upload mb-0">
                                            <a class="defbtn"><i class="icon-arrow-right"></i>Your CV</a>
                                        </label>
                                        <input id="file-upload" class="form-control-file d-none" type="file">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="legal"
                                                v-model="isArial">
                                            <label class="form-check-label" for="legal">
                                                I have read and agree to the <a href="" class="ul">Privacy
                                                    Policy</a>.
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="defbtn"><i class="icon-arrow-right"></i>SUBMIT
                                        APPLICATION</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- showreel -->

    <div class="main-testimony-container on-career">
        <div class="testimony-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2>We are neo<span class="yellow">.</span><br>
                            A full-service communication
                            and media agency with a digital focus<span class="yellow">.</span></h2>
                        <div class="testimony-btn">
                            <a href="" class="defbtn"><i class="icon-arrow-right"></i>DISCOVER THE NEO METHOD</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="showreel" style="background-image: url('images/main/showreel.png')">
            <a href="" class="defbtn white"><i class="icon-play"></i>view our showreel</a>
        </div>
    </div>
@endsection
