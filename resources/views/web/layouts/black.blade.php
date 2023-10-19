<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    
    @include('web.layouts.head.head')
</head>

<body id="page-top" class="preload template-black">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NDXP56H" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    @include('web.layouts.header.header')

    <!-- content -->
    <div class="main-container">
        @section('body')
        @show
    </div>

    @include('web.layouts.footer.footer')
    @include('web.layouts.footer.scripts')
</body>

</html>
