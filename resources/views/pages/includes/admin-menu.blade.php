<nav class="bg-white p-4 flex">

    <x-html.a-blue
        href="{{ route('admin:pages') }}"
        text="Страницы"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{ route('admin:menu') }}"
        text="Меню"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{ route('admin:menu-items') }}"
        text="Пункты меню"
    />
</nav>



