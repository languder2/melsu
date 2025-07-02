<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}

    <link rel="shortcut icon" href="{{url('favicons/favicon.ico')}}" type="image/x-icon"/>

    <title>@yield('title', 'ФГБОУ ВО "МелГУ"')</title>

    @vite(['resources/css/cabinet.css', 'resources/js/cabinet.js'])

    @hasSection('includes')
        @yield('includes')
    @endif
</head>
<body class="bg-neutral-100 relative grid grid-rows-[auto_1fr_auto] min-h-screen gap-0">

<main class="min-h-full bg-amber grid grid-cols-[400px_1fr] w-full ">
    <div class="bg-red">
        @include('info.menu')
    </div>
    <div class="h-screen overflow-auto relative">

        @include("info.header")

        <div class="flex flex-col gap-4 px-3 py-4">
            <div class="content-header text-2xl font-semibold">
                @hasSection('content-header')
                    @yield('content-header')
                @endif
            </div>

            @yield('content')
        </div>
    </div>
</main>

</body>
</html>
