<div class="bg-white rounded-md p-4 flex">
    <h2 class="flex-1 text-2xl font-semibold">
        Сотрудники
    </h2>
    <div>
        <a
            href="{{route('admin:staff:add')}}"
            class="
                py-2 px-4
                rounded-md
                text-white
                bg-blue-950 hover:bg-blue-700 active:bg-gray-700
            "
        >
            <i class="fas fa-user-plus w-4 py-2"></i>
        </a>
    </div>
</div>

<x-admin.staff.search />
