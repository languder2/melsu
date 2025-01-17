
@foreach($list as $category)
    <div class="bg-white rounded-md p-4 mb-4">

        <h4 class="font-semibold uppercase text-lg pb-2">
            {{$category->detail->name}}
        </h4>

        <hr>

        <div
            class="
                grid gap-4 items-center
                grid-cols-1
                md:grid-cols-[repeat(6,minmax(0,_1fr))_200px]
            "
        >
            <div class="font-semibold">
                ID
            </div>

            <div class="font-semibold">
                Название
            </div>

            <div class="font-semibold">
                Описание
            </div>

            <div class="font-semibold">
                Route
            </div>

            <div class="font-semibold">
                Link
            </div>

            <div class="font-semibold">
                Parent
            </div>

            <div></div>

            @foreach($category->menu as $record)
                <div>
                    {{$record->id}}
                </div>

                <div>
                    {{$record->name}}
                </div>

                <div>
                    {{$record->comment}}
                </div>

                <div>
                    {{$record->route}}
                </div>

                <div>
                    {{$record->link}}
                </div>

                <div>
                    {{$record->parent}}
                </div>

                <div>
                    <div class="flex flex-row-reverse text-white w-full">
                        <div class="flex-none w-14">
                            <a
                                href="{{route('admin:menu:delete',$record->id)}}"
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
                                href="{{route('admin:menu:edit',$record->id)}}"
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
                <hr class="md:col-span-7 last:hidden">
            @endforeach
        </div>

    </div>

@endforeach
