<nav class="bg-white rounded-md p-4 mb-4 flex">

    <x-html.a-blue
        href="{{route('admin:education:faculty:list')}}"
        text="Факультеты"
        :active="str_contains(url()->current(),route('admin:education:faculty:list'))"
    />

    <span class="inline-block mx-3 opacity-30">
            |
    </span>

    <x-html.a-blue
        href="{{route('admin:education-department:list')}}"
        text="Отделы"
        :active="str_contains(url()->current(),route('admin:education-department:list'))"
    />

    <span class="inline-block mx-3 opacity-30">
            |
    </span>

    <x-html.a-blue
        href="{{route('admin:education:labs:list')}}"
        text="Лаборатории"
        :active="str_contains(url()->current(),route('admin:education:labs:list'))"
    />

    <span class="inline-block mx-3 opacity-30">
            |
    </span>

    <x-html.a-blue
        href="{{route('admin:education-speciality:list')}}"
        text="Специальности"
        :active="str_contains(url()->current(),route('admin:education-speciality:list'))"
    />

</nav>



