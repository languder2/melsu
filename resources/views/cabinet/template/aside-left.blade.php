<aside class="left w-70 relative">
    <div class="inset-0 overflow-y-scroll flex flex-col gap-2 py-2 sticky top-0">
        <a
            href="{{ route('news.cabinet.list') }}"

            {{ Route::is('news.cabinet.*') ? "open" : "" }}

            class="
                cursor-pointer block p-3
                mx-2 rounded-sm
                bg-white shadow
                hover:bg-blue-700 hover:text-white
                hover:-mt-0.5 hover:mb-0.5
                duration-300
                open:text-white open:bg-sky-800
                open:hover:text-white open:hover:bg-blue-700
            "
        >
            Новости
        </a>

        <a
            href="{{ route('events.cabinet.list') }}"

            {{ Route::is('events.cabinet.*') ? "open" : "" }}

            class="
                cursor-pointer block p-3
                mx-2 rounded-sm
                bg-white shadow
                hover:bg-blue-700 hover:text-white
                hover:-mt-0.5 hover:mb-0.5
                duration-300
                open:text-white open:bg-sky-800
                open:hover:text-white open:hover:bg-blue-700
            "
        >
            Мероприятия
        </a>

        <a
            href="{{ route('divisions.cabinet.list') }}"

            {{ Route::is('division*.cabinet.*') ? "open" : "" }}

            class="
                cursor-pointer block p-3
                mx-2 rounded-sm
                bg-white shadow
                hover:bg-blue-700 hover:text-white
                hover:-mt-0.5 hover:mb-0.5
                duration-300
                open:text-white open:bg-sky-800
                open:hover:text-white open:hover:bg-blue-700
            "
        >
            Подразделения
        </a>

        <a
            href="{{ route('divisions.cabinet.list') }}"

            {{--            {{ Route::is('division*.cabinet.*') ? "open" : "" }}--}}

            class="
                cursor-pointer block p-3
                mx-2 rounded-sm
                bg-white shadow
                hover:bg-blue-700 hover:text-white
                hover:-mt-0.5 hover:mb-0.5
                duration-300
                open:text-white open:bg-sky-800
                open:hover:text-white open:hover:bg-blue-700
            "
        >
            Страницы
        </a>

    </div>
</aside>

