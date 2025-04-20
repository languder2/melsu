<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{url('favicons/favicon.ico')}}" type="image/x-icon" />

    <title>@yield('title', 'ФГБОУ ВО "МелГУ"')</title>

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    @hasSection('includes')
        @yield('includes')
    @endif
</head>
<body class="bg-gray-200">
@guest
    <x-admin.login/>
@endguest
@auth
    <div class="ml-14 p-4">
        <section>
            @hasSection('top-menu')
                @yield('top-menu')
            @endif

            @hasSection('header')
                @yield('header')
            @endif

            @hasSection('content-header')
                @yield('content-header')
            @endif

            @yield('content')
        </section>
    </div>
    <x-admin.sidebar/>
@endauth

<div id="adminMessageBox" class="flex flex-col gap-0 fixed bottom-6 right-6 select-none">
    <div
        class="
            example
            bg-black/70 text-white rounded-lg
            w-96 mt-0 overflow-hidden
            transition-all duration-500
            opacity-0
            max-h-0
            cursor-pointer
            hidden
        "
    >
        <div class="text-right">
            <div class="message-time border-b border-b-gray-50/30 px-4 pt-2 pb-1 text-xs">
                {{date("H:i:s")}}
            </div>
            <div class="message-content p-4 pt-2">

            </div>
        </div>
    </div>
</div>

</body>
</html>
