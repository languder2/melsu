<div class="
    bg-blue-900
    duration-300

    fixed z-50
    left-0 top-0 bottom-0
    w-14 p-4

    hover:w-60
    hover:bg-blue-700
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
