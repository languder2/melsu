<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'ФГБОУ ВО "МелГУ"')</title>

    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="main-wrapper">

    <x-template.header />

    <section class="main-section">

        <div class="sidebar"></div>

        <div class="content-block mt-24 ml-96 text-lg leading-8 ">
            @yield('content')
        </div>

    </section>


    <x-template.footer />

    <x-template.left-side-offset />
</div>
</body>
</html>
