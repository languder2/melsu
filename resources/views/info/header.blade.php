<header
    class="py-1 text-white bg-cover bg-[image:var(--bg-sveden-header)]"
>
    <nav class="px-2 lg:mx-auto max-w-1600 flex items-center gap-4 :bg-red-300">
        <a href="{{route('pages:main')}}" target="_blank" class="focus:outline-0">
            <img src="{{asset('img/cabinet/logo.svg')}}" alt="" />
        </a>
        <div>
            {{ $title ?? null }}
        </div>
        <div class="flex-1"></div>
        <ul class="flex gap-4">
            <li></li>
            <li></li>
            <li></li>
            <li>
                <a href="{{route('sveden:common')}}"
                   class="flex gap-3 py-3 px-5 hover:bg-red-700 rounded-md focus:outline-0"
                >
                    Общие сведения
                </a>
            </li>
        </ul>
    </nav>
</header>
