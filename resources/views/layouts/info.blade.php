<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{url('favicons/favicon.ico')}}" type="image/x-icon"/>

    <title>@yield('title', 'ФГБОУ ВО "МелГУ"')</title>

    @vite(['resources/css/cabinet.css', 'resources/js/cabinet.js'])

    @hasSection('includes')
        @yield('includes')
    @endif
</head>
<body class="bg-neutral-100 relative grid grid-rows-[auto_1fr_auto] min-h-screen gap-px">

@include("info.header")

<main class="min-h-full bg-amber py-4">
    <div class="flex flex-col gap-4 p-4 max-w-[1400px] mx-auto">

        <div class="content-header text-2xl font-semibold">
            @hasSection('content-header')
                @yield('content-header')
            @endif
        </div>

        @yield('content')
    </div>
</main>

@include("info.footer")

</body>
</html>
