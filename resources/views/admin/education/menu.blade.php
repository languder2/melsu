<nav class="bg-white rounded-md p-4 mb-4 flex">

    <x-html.a-blue
        href="{{route('admin:education:branches:list')}}"
        text="Филиалы"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('admin:education:faculty:list')}}"
        text="Факультеты"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('admin:education-department:list')}}"
        text="Кафедры"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('admin:education:labs:list')}}"
        text="Лаборатории"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('admin:education-speciality:list')}}"
        text="Специальности"
    />

</nav>



