<nav class="bg-white p-4 flex">

    <x-html.a-blue
        href="{{route('branches:admin')}}"
        text="Филиалы"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('admin:institutes:list')}}"
        text="Институты"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('admin:faculty:list')}}"
        text="Факультеты"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('admin:department:list')}}"
        text="Кафедры"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('admin:lab:list')}}"
        text="Лаборатории"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('admin:speciality:list')}}"
        text="Специальности"
    />

</nav>



