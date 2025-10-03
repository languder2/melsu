<aside class="left bg-neutral-150 w-80 border-r drop-shadow-md relative">
    <h3 class="font-semibold p-4 ">
        Меню
    </h3>
    <hr class="border-blue">
    <div class="absolute inset-0 top-15 overflow-y-scroll flex flex-col">
        <a
            href="{{ route('news.cabinet.list') }}"

            {{ Route::is('news.cabinet.*') ? "open" : "" }}

            class="
                cursor-pointer block p-3
                hover:bg-slate-200
                open:text-white open:bg-sky-800
                open:hover:text-white open:hover:bg-sky-800
            "
        >
            Новости
        </a>

        <a
            href="{{ route('cabinet.news.onApproval') }}"

            {{ Route::is('cabinet.news.onApproval') ? "open" : "" }}

            class="
                cursor-pointer block p-3
                hover:bg-slate-200
                open:text-white open:bg-sky-800
                open:hover:text-white open:hover:bg-sky-800
            "
        >
            Новости на утверждении
        </a>


        <a
            href="{{ route('divisions.cabinet.list') }}"

            {{ Route::is('divisions.cabinet.*') ? "open" : "" }}

            class="
                cursor-pointer block p-3
                hover:bg-slate-200
                open:text-white open:bg-sky-800
                open:hover:text-white open:hover:bg-sky-800
            "
        >
            Подразделения
        </a>
    </div>
</aside>

