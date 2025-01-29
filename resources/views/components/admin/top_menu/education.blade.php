<div class="bg-white rounded-md p-4 mb-4 flex">

    <x-html.a-blue
        href="{{route('admin:pages')}}"
        text="Факультеты"
        active="{!! ($active==='faculties')?true:null !!}"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:menu')}}"
        text="Отделы"
        active="{!! ($active==='departments')?true:null !!}"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:menu')}}"
        text="Специальности"
        active="{!! ($active==='profiles')?true:null !!}"
    />

</div>
