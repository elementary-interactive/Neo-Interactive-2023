@extends('web.layouts.default')

@section('body')
    <!-- carrer subpage -->

    <div class="carrer-container default-padding-w menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2>Állásajánlatod megérkezett hozzánk:</h2>
                    <div class="row def-b-margin">
                        <div class="col-12 col-xl-9">
                            <h1 class="mb-0">Köszönjük.</h1>
                        </div>
                    </div>

                    <div class="row">

                        <!-- description -->

                        <div class="col-12 col-xl-6">
                            <div class="carrer-registration-desc basic-text-container">
                                Állásajánlatod fölött most álmatlan éjszakák tömkelegét töltjük majd el.
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
            <a href="" class="defbtn white showreel-btn"><i class="icon-play"></i>{{ $attributes['main_cta-showreel_title'] }}</a>
            <div class="embed-youtube">
            <iframe width="560" height="315" class="video-iframe" src="https://www.youtube.com/embed/2kPJU06DWLA?si=3WKzv3dj8Ip2G5yt" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection
