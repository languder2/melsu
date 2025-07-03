<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    {{--    <meta name="viewport"--}}
    {{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}

    <link rel="shortcut icon" href="{{url('favicons/favicon.ico')}}" type="image/x-icon"/>

    <title>@yield('title', 'ФГБОУ ВО "МелГУ"')</title>

    @vite(['resources/css/info.css', 'resources/js/info.js'])

    @hasSection('includes')
        @yield('includes')
    @endif
</head>
<body class="bg-neutral-100">
<div class="h-screen grid grid-rows-[auto_1fr_auto] grid-cols-1 gap-px overflow-hidden">
    <header class=" col-span-2 flex items-center justify-center sticky top-0">
        @include("info.header")
    </header>

    <div class="grid grid-cols-[400px_1fr] overflow-y-auto">
        <div class="{{ auth()->check() ? 'bg-blue' : 'bg-red' }}">
            @include("info.menu")
        </div>

        <div class="bg-gray-100 overflow-scroll ml-4">
            @hasSection('content-header')
                <div class="content-header text-2xl font-semibold py-3">
                    @yield('content-header')
                </div>
            @endif
            <div class="flex flex-col gap-4 relative h-full">
                @yield('content')
            </div>
        </div>
    </div>

    <footer class="col-span-2 flex items-center justify-center sticky bottom-0">
        @include("info.footer")
    </footer>
</div>


@include("info.modal")

</body>
</html>
