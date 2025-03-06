<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{url('favicons/favicon.ico')}}" type="image/x-icon" />

    <title>@yield('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')</title>

    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="main-wrapper">

    <x-template.header/>

    <section class="main-section">

        <section class="container py-5">
            @yield('breadcrumbs')

            <div class="grid grid-cols-1 lg:grid-cols-[25%_minmax(70%,1fr)] gap-3">
                <div class="left-side-menu-box hidden lg:block ">
                    <div class="bg-white p-2.5">
                        @yield('sidebar')
                    </div>
                </div>
                @if(isset($nobg) && $nobg === true)
                    <div class="main-content">
                        @yield('content')
                    </div>
                @else
                    @hasSection('content')
                        <div class="main-content p-5 pt-[1.375rem] bg-white">
                            @yield('content')
                        </div>
                    @else
                        <div class="main-content">
                            @yield('content-without-bg')
                        </div>
                    @endif
                @endif


            </div>
        </section>
    </section>

    @yield('news')

    <x-template.footer/>

    <x-template.left-side-offset/>
</div>
</body>
</html>
