@extends('web.layouts.error')

@section('body')
    <!-- error page -->

    <div class="error-page default-padding menu-top-margin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>404<span class="yellow">.</span></h1>
                    <h3>{{ __("We couldn't find the content you were looking for.") }}</h3>
                    <a href="/" class="defbtn"><i class="icon-arrow-left"></i> {{ __("Back to main page") }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
