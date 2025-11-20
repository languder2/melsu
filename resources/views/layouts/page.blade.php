<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{url('favicons/favicon.ico')}}" type="image/x-icon" />

    <title>@yield('title', 'ФГБОУ ВО «Мелитопольский государственный университет»')</title>

    @yield('meta')

    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/editorjs/slider.js'])

</head>
<body>
<div class="main-wrapper">

    <x-template.header/>

    <section
        class="main-content @hasSection('aside') container @endif"
    >
        <div class="my-6">
            @yield('breadcrumbs')
        </div>

        <div class="flex gap-4 mb-6">
            @hasSection('aside')
                <div class="left-side-menu-box hidden lg:flex flex-col w-96 ">
                    <div class="bg-white p-2.5 grow">
                        @yield('aside')
                    </div>
                </div>
            @endif
            @hasSection('content')
                <section class="mx-auto flex-1 max-w-full">
                    @yield('content')
                </section>
            @endif
        </div>
    </section>

    <x-template.footer/>

    <x-template.left-side-offset/>

</div>
</body>
</html>
