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
            alias
        </div>

        <div class="font-semibold md:col-span-2">
            Наименование
        </div>

        <div class="font-semibold md:col-span-2">
            Ссылка
        </div>

        <div class="font-semibold">
            Parent
        </div>

        <div></div>

        @foreach($list as $record)
            <div>
                {{$record->id}}
            </div>

            <div>
                {{$record->alias}}
            </div>

            <div class="md:col-span-2">
                {{$record->name}}
            </div>

            <div class="md:col-span-2">
                @if(Route::has($record->route))
                    {{url(route($record->route))}}
                @elseif(!empty($record->alias))
                    {{url($record->alias)}}
                @endif
            </div>

            <div>
                {{@$record->parentPage->name}}
            </div>

            <div>
                <div class="flex flex-row-reverse text-white w-full">
                    <div class="flex-none w-14">
                        <a
                            href="{{route('admin:pages:delete',$record->id??0)}}"
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
                            href="{{route('admin:pages:edit',$record->id??0)}}"
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

</div>
