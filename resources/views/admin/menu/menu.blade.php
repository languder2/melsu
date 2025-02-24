<nav class="bg-white rounded-md p-4 mb-4 flex">

    <x-html.a-blue
        href="{{route('admin:pages')}}"
        text="Страницы"
        :active="str_contains(url()->current(),route('admin:pages'))"
    />

    <span class="inline-block mx-3 opacity-30">
            |
    </span>

    <x-html.a-blue
        href="{{route('admin:menu')}}"
        text="Меню"
        :active="str_contains(url()->current(),route('admin:menu'))"
    />

    <span class="inline-block mx-3 opacity-30">
            |
    </span>

    <x-html.a-blue
        href="{{route('admin:menu-items')}}"
        text="Пункты меню"
        :active="str_contains(url()->current(),route('admin:menu-items'))"
    />

</nav>



