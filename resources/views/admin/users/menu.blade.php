<nav class="bg-white p-4 flex">

    <x-html.a-blue
        href="{{route('admin:users:list')}}"
        text="Пользователи"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('admin:staff')}}"
        text="Сотрудники"
    />


</nav>



