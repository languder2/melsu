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
<body class="bg-neutral-100 relative grid grid-rows-[auto_1fr_auto] min-h-screen gap-px">

@include("cabinet.template.header")

<main class="min-h-full bg-amber" >
    @guest
        @include('cabinet.auth')
    @else
        <div class="flex gap-4 min-h-full">
            <div class="hidden">
                123
            </div>

            @include('cabinet.template.aside-left')

            <div class="flex-1">
                @hasSection('content-header')
                    @yield('content-header')
                @endif
                @yield('content')
            </div>

            @include('cabinet.template.aside-right')
        </div>
    @endguest
</main>
@include("cabinet.template.footer")

</body>
</html>
