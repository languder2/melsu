<div class="
    bg-blue-950
    duration-300

    fixed z-50
    right-0 top-0 bottom-0
    w-14 p-4

    hover:w-72
    hover:bg-blue-800
">
    <ul class="text-2xl">

        <x-admin.sidebar-li
            link="{{route('admin:structure')}}"
            ico="fas fa-project-diagram text-lg"
            text="структура"
        />

        <x-admin.sidebar-li
            link="{{route('admin:logout')}}"
            ico="fas fa-sign-out-alt"
            text="выход"
        />


    </ul>
</div>
