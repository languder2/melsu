<div class="bg-white rounded-md p-4 mb-4 flex">

    <x-html.a-blue
        href="{{route('admin:education:faculty:list')}}"
        text="Факультеты"
        active="{!! ($active==='faculties')?true:null !!}"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:education-department:list')}}"
        text="Отделы"
        active="{!! ($active==='departments')?true:null !!}"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:education-speciality:list')}}"
        text="Специальности"
        active="{!! ($active==='specialities')?true:null !!}"
    />

</div>
