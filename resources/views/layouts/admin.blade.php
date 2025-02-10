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
<body class="bg-gray-200">
@guest
    <x-admin.login/>
@endguest
@auth
    <div class="ml-14 p-4">
        <section>

            @yield('content')

        </section>
    </div>
    <x-admin.sidebar/>
@endauth

</body>
</html>
