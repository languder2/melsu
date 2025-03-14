<div class="bg-white rounded-md p-4 mb-4">

    <div class="pb-2 ps-2 mb-4 flex border-b">
        <h2 class="flex-1 text-2xl font-semibold">
            {{$section->name ?? $name ?? null}}
        </h2>
        @isset($section)
            <div>
                <a
                    href="{{route('admin:education-speciality:add')."?faculty={$section->code}"}}"
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
            md:grid-cols-[50px_100px_repeat(6,minmax(0,1fr))_200px]
        "
    >
        <div class="font-semibold text-center">
            ID
        </div>

        <div class="font-semibold">
            Код
        </div>

        <div class="font-semibold">
            Уровень
        </div>

        <div class="font-semibold md:col-span-2">
            Наименование
        </div>

        <div class="font-semibold">
            Alias
        </div>

        <div class="font-semibold">
            Кафедра
        </div>

        <div class="font-semibold">
            Формы
        </div>

        <div></div>

        @each('admin.education.specialities.item',$section->specialities ?? $list ?? [],'record')
    </div>
</div>

