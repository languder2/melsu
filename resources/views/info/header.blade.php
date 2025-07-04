<header
    class="
        w-full py-4 text-white bg-cover
{{--        bg-[image:var({{ auth()->check() ? "--bg-cabinet-header" : "--bg-sveden-header" }})]--}}
        sticky top-0 left-0
    "
    style="background-image: url({{ auth()->check() ? asset("img/cabinet/bg-header.png") : asset("img/sveden/bg-sved.jpg") }})"
>
    <nav class="px-4 flex items-center gap-4 :bg-red-300">
        <a href="{{ url('/') }}" class="text-white flex gap-4 items-center">
            <img src="{{asset('img/cabinet/logo.svg')}}" alt="" class="h-10" /> Главная
        </a>
        <div>
            {{ $title ?? null }}
        </div>
        <div class="flex-1"></div>
        <ul class="flex gap-4 items-center">
            <li></li>
            <li></li>
            <li>
                <a href="#" itemprop="copy">
                    ...
                </a>
            </li>
            <li>
                @guest
                    <a
                        href="{{ route('info:login') }}"
                        class="flex gap-2 items-center px-4 py-2 hover:bg-red-800 rounded"
                    >
                        кабинет
                        <img src="{{ asset('img/info/login.svg') }}" alt="login" class="rotate-180">
                    </a>
                @else
                    <a
                        href="{{ route('info:exit') }}"
                        class="flex gap-2 items-center px-4 py-2 hover:bg-blue-950 rounded"
                    >
                        <img src="{{ asset('img/info/logout.svg') }}" alt="logout">
                        выход
                    </a>
                @endguest
            </li>


        </ul>
    </nav>
</header>
