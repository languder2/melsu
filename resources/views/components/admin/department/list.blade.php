<div class="bg-white rounded-md p-4 mb-4">

    <div
        class="
            grid gap-4 items-center
            grid-cols-1
            md:grid-cols-[repeat(7,minmax(0,1fr))_200px]
        "
    >
        <div class="font-semibold">
            ID
        </div>

        <div class="font-semibold">
            Название
        </div>

        <div class="font-semibold">
            Должность
        </div>

        <div class="md:col-span-2 font-semibold">
            Начальник
        </div>

        <div class="md:col-span-2 font-semibold">
            ссылки
        </div>

        <div></div>

        @foreach($list as $record)
            <div>
                    <?= $record->id ?>
            </div>

            <div>
                    <?= $record->name ?>
            </div>

            <div>
                    <?= $record->chief_post ?>
            </div>

            <div class="md:col-span-2">
                    <?= $record->lastname ?>
                    <?= $record->firstname ?>
                    <?= $record->middle_name ?>
            </div>

            <div class="md:col-span-2">
                {{url(route('public:department:show',$record->id))}}
                @if(!empty($record->alias))
                    <br>
                    {{url(route('public:department:show',$record->alias))}}
                @endif
            </div>

            <div>
                <div class="flex flex-row-reverse text-white w-full">
                    <div class="flex-none w-14">
                        <a
                            href="{{route('admin:division:delete',$record->id)}}"
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
                            href="{{route('admin:division:edit',$record->id)}}"
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
            <hr class="md:col-span-8 last:hidden">
        @endforeach
    </div>

    <hr class="my-4">

    {!! @$list->links() !!}
</div>
