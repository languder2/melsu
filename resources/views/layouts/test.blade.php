<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{url('favicons/favicon.ico')}}" type="image/x-icon" />

    <title>@yield('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col h-screen">
    <div class="bg-cyan-800 p-8">
        1
    </div>
    <div class="flex-grow">
        <main class="bg-amber-400 min-h-full">
            123
        </main>
    </div>
    <div class="bg-cyan-800 p-4">
        3
    </div>
</body>
</html>
