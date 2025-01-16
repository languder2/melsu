<div class="bg-white rounded-md p-4 mb-4 flex">
    <x-html.a-blue
        href="{{url(route('admin:menu'))}}"
        text="Список меню"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{url(route('admin:menu-categories'))}}"
        text="Категории меню"
        active
    />
</div>

<div class="bg-white rounded-md p-4 mb-4 flex">
    <h2 class="flex-1 text-2xl font-semibold">
        Категории меню
    </h2>
    <div>
        <a
            href="{{route('admin:menu-categories:add')}}"
            class="
                py-2 px-4
                rounded-md
                text-white
                bg-blue-950 hover:bg-blue-700 active:bg-gray-700
            "
        >
            <i class="fas fa-plus w-4 py-2"></i>
        </a>
    </div>
</div>
