<div class="bg-white rounded-md p-4 mb-4">

    <div class="pb-2 ps-2 mb-4 flex border-b">
        <h2 class="flex-1 text-2xl font-semibold">
            {{$section->name ?? $name ?? null}}
        </h2>
        @isset($section)
            <div>
                <a
                    href="{{ $section->add_speciality }}"
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
        @endisset
    </div>

    <div
        class="
            grid gap-4 items-center
            grid-cols-1
            md:grid-cols-[auto_auto_1fr_auto_1fr_1fr_auto_auto_auto]
        "
    >
        <div class="font-semibold text-center">
            ID
        </div>

        <div class="font-semibold">
            Уровень
        </div>

        <div class="font-semibold">
            Parent
        </div>

        <div class="font-semibold">
            Код
        </div>

        <div class="font-semibold md:col-span-2">
            Наименование
        </div>

        <div class="font-semibold">
            Ссылка
        </div>

        <div class="font-semibold">
            Формы
        </div>

        <div></div>

        @each('specialities.admin.item-with-parent',$list ?? $section->specialities('all')->get() ?? [],'record')
    </div>
</div>

