<div class="bg-white rounded-md p-4 mb-4">

    <div class="pb-2 ps-2 mb-4 flex border-b">
        <h2 class="flex-1 text-2xl font-semibold">
            {{$faculty->name ?? 'Без факультета'}}
        </h2>

        @if($faculty)
            <div>
                <a
                    href="{{route('admin:education-department:add')."?faculty={$faculty->code}"}}"
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
        @endif
    </div>

    <div
        class="
            grid gap-4 items-center
            grid-cols-1
            md:grid-cols-[auto_2fr_1fr_auto_auto]
        "
    >
        <div class="font-semibold text-center">
            ID
        </div>

        <div class="font-semibold">
            Наименование
        </div>

        <div class="font-semibold">
            Alias
        </div>

        <div class="font-semibold">
            Specs
        </div>

        <div></div>

        @foreach($list as $record)
            <div class="text-center">
                {{$record->id}}
            </div>

            <div class="md">
                {{$record->name}}
            </div>

            <div>
                {{$record->code}}
            </div>

            <div>
                {!! $record->specialities()->count() !!}
            </div>

            <div>
                <div class="flex flex-row-reverse text-white w-full">
                    <div class="flex-none w-14">
                        <a
                            href="{{route('admin:education-department:delete',$record->id??0)}}"
                            class="
                                py-2 px-4 rounded-md
                                bg-red-950
                                hover:bg-red-700
                                active:bg-gray-700
                            "
                        >
                            <i class="fas fa-trash w-4 h-4"></i>
                        </a>
                    </div>
                    <div class="flex-none w-14">
                        <a
                            href="{{route('admin:education-department:edit',$record->id??0)}}"
                            class="
                                py-2 px-4 rounded-md
                                bg-green-950
                                hover:bg-green-700
                                active:bg-gray-700
                            "
                        >
                            <i class="far fa-edit w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="md:col-span-5 last:hidden">
        @endforeach
    </div>
</div>

