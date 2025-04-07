<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{url('favicons/favicon.ico')}}" type="image/x-icon" />

    <title>@yield('title', 'ФГБОУ ВО "МелГУ"')</title>

    @vite(['resources/css/cabinet.css', 'resources/js/cabinet.js'])

    @hasSection('includes')
        @yield('includes')
    @endif
</head>
<body class="bg-neutral-100 relative flex flex-col min-h-screen">

@include("cabinet.template.header")
@guest
    <main class="flex-grow flex items-center justify-center">
        @include('cabinet.form.login')
    </main>
@else
    <main class="flex-grow">

        @hasSection('header')
            @yield('header')
        @endif

        @hasSection('content-header')
            @yield('content-header')
        @endif

        @yield('content')
    </main>
@endguest
@include("cabinet.template.header")
</body>
</html>
