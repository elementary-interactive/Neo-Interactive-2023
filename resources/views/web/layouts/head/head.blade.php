<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1">


{{-- <link rel="icon" href="/images/favicon/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/images/favicon/favicon.ico" />
<link rel="icon" href="/images/favicon/favicon.png" sizes="32x32" />
<link rel="icon" href="/images/favicon/favicon-1.png" sizes="192x192" />
<link rel="apple-touch-icon-precomposed" href="/images/favicon/apple-touch-icon.png" />
<meta name="msapplication-TileImage" content="/images/favicon/favicon-2.png" /> --}}

{{--
    Include meta tags.
--}}
@stack('meta')
{{--
    Include OpenGraph related elements.
--}}
@stack('og')

{{--
    Favicon by Neon Site. (If Neon Site is set, please uncomment.)
--}}
<x-neon-favicon/>

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> --}}

<link rel="stylesheet" href="https://use.typekit.net/kjr0rpe.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

@vite([
  'resources/css/style.scss',
])

{{--
  'resources/js/splide.min.js',
  
]) --}}
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-NDXP56H');</script>
<!-- End Google Tag Manager -->

{{--

@if (config('app.env') == 'production' && config('facebook.pixel-id'))
<!-- Meta Pixel Code --> <script> !function(f,b,e,v,n,t,s) {if(f.fbq)return;n=f.fbq=function(){n.callMethod? n.callMethod.apply(n,arguments):n.queue.push(arguments)}; if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0'; n.queue=[];t=b.createElement(e);t.async=!0; t.src=v;s=b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s)}(window, document,'script', 'https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '{{ config('facebook.pixel-id') }}'); fbq('track', 'PageView'); </script> <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ config('facebook.pixel-id') }}&ev=PageView&noscript=1" /></noscript> <!-- End Meta Pixel Code -->
@endif


<script>
    var cookie_statement = "{{ route('document', ['slug' => app('site')->current()?->document_cookie]) }}",
        cookie_lang = "{{ app()->getLocale() }}";
</script>
--}}

{{--
    Javascript parts which should be included in the header.
--}}
@stack('scripts-head')
