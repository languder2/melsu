<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{url('favicons/favicon.ico')}}" type="image/x-icon"/>
    <title>@yield('title', 'ФГБОУ ВО "МелГУ"')</title>
    @vite(['resources/css/info.css', 'resources/js/info.js'])
    @hasSection('includes')
        @yield('includes')
    @endif
</head>
<body class="bg-neutral-100">

<div class="min-h-screen flex flex-col">

{{--    <header class="flex items-center justify-center sticky top-0 z-30 bg-white shadow-sm">--}}
{{--        @include("info.header")--}}
{{--    </header>--}}

    <div class="flex-1 grid grid-cols-[400px_1fr]">

        <div class="{{ auth()->check() ? 'bg-blue' : 'bg-red' }} py-4">
            @include("info.menu")
        </div>

        <div class="bg-gray-100 px-6 py-4 min-w-0">
            @hasSection('content-header')
                <div class="content-header text-2xl font-semibold pb-3">
                    @yield('content-header')
                </div>
            @endif

            <div class="flex flex-col gap-4 relative">
                @yield('content')
                {{ $slot ?? null }}
            </div>
        </div>
    </div>
{{--    <footer class="flex items-center justify-center bg-white mt-auto">--}}
{{--        @include("info.footer")--}}
{{--    </footer>--}}
</div>

@include("info.modal")
</body>
</html>
