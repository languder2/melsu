<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{url('favicons/favicon.ico')}}" type="image/x-icon" />

    <title>@yield('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')</title>

    @yield('includes')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="{{asset('js/timeline-slider.js')}}"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="main-wrapper">

    <x-template.header/>

    @yield('breadcrumbs')

    <section class="main-section">
        @yield('content')
    </section>


    <x-template.footer/>

    <x-template.left-side-offset/>
</div>
</body>
</html>
