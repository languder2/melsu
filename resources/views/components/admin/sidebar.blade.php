<div class="
    bg-blue-950
    duration-300

    fixed z-50
    left-0 top-0 bottom-0
    w-14 p-4

    hover:w-72
    hover:bg-blue-800
">
    <ul class="text-2xl">

        <x-admin.sidebar-li
            link="{{url('/')}}"
            img="bg-white-logo.png"
            text="Frontend"
        />

        <x-admin.sidebar-li
            link="{{route('admin:structure')}}"
            ico="fas fa-project-diagram text-lg"
            text="структура"
        />

        <x-admin.sidebar-li
            link="{{route('admin:news')}}"
            ico="far fa-calendar-check"
            text="новости"
        />

        <x-admin.sidebar-li
            link="{{route('admin:staff')}}"
            ico="fas fa-users text-lg"
            text="сотрудники"
        />

        <x-admin.sidebar-li
            link="{{route('admin:department')}}"
            ico="fas fa-align-left"
            text="департаменты"
        />

        <x-admin.sidebar-li
            link="{{route('admin:pages')}}"
            ico="fas fa-bars"
            text="Страницы"
        />

        <x-admin.sidebar-li
            link="{{route('admin:education-faculty:list')}}"
            ico="fas fa-university"
            text="Обучение"
        />

        <x-admin.sidebar-li
            link="{{route('admin:logout')}}"
            ico="fas fa-sign-out-alt"
            text="выход"
        />
    </ul>

    <i class="fas fa-outdent"></i>
    <i class="fas fa-indent"></i>

    <i class="fab fa-squarespace"></i>
</div>


