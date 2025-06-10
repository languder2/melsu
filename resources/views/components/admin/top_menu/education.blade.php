<div class="bg-white rounded-md p-4 flex">

    <x-html.a-blue
        href="{{route('admin:faculty:list')}}"
        text="Факультеты"
        active="{!! ($active==='faculties')?true:null !!}"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:department:list')}}"
        text="Отделы"
        active="{!! ($active==='departments')?true:null !!}"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:speciality:list')}}"
        text="Специальности"
        active="{!! ($active==='specialities')?true:null !!}"
    />

</div>
