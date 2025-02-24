<div class="bg-white rounded-md p-4 mb-4 flex">

    <x-html.a-blue
        href="{{route('admin:department-group:list')}}"
        text="Группы"
        :active="str_contains(url()->current(),route('admin:department-group:list'))"
    />




    <span class="inline-block mx-3 opacity-30">
            |
    </span>

    <x-html.a-blue
        href="{{route('admin:department:list')}}"
        text="Подразделения"
        :active="str_contains(url()->current(),route('admin:department:list'))"
    />

</div>


