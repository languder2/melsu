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
            text="Главная"
        />

        <x-admin.sidebar-li
            link="{{route('admin:news')}}"
            ico="far fa-calendar-check"
            text="Новости"
        />

        <x-admin.sidebar-li
            link="{{route('admin:pages')}}"
            ico="fas fa-bars"
            text="Страницы"
        />

        <x-admin.sidebar-li
            link="{{route('admin:division:list')}}"
            ico="fas fa-sitemap"
            text="Структура"
            class="text-lg"
        />

        <x-admin.sidebar-li
            link="{{route('admin:faculty:list')}}"
            ico="fas fa-university"
            text="Университет"
        />

        <x-admin.sidebar-li
            link="{{route('admin:staff')}}"
            ico="fas fa-users text-lg"
            text="Сотрудники"
        />


        <x-admin.sidebar-li
            link="{{route('admin:image:list')}}"
            ico="far fa-images"
            text="Gallery"
            class="text-xl"
        />

        <x-admin.sidebar-li
            link="{{route('schedule.page')}}"
            ico="fas fa-calendar-alt fa-lg"
            text="Расписание"
            class="text-xl"
        />

        <x-admin.sidebar-li
            link="{{route('handbook.collections')}}"
            ico="fas fa-solid fa-book"
            text="Справочники"
            class="text-xl"
        />

        <x-admin.sidebar-li
            link="{{route('admin:logout')}}"
            ico="fas fa-sign-out-alt"
            text="Выход"
        />
    </ul>
</div>


