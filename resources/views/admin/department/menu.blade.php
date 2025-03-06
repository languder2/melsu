<div class="bg-white rounded-md p-4 mb-4 flex">

    <x-html.a-blue
        href="{{route('admin:department:list')}}"
        text="Подразделения"
        :active="str_contains(url()->current(),route('admin:department:list'))"
    />

</div>


