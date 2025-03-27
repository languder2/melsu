<div class="bg-white rounded-md p-4 mb-4">

    <div
        class="
            grid gap-4 items-center
            grid-cols-1
            md:grid-cols-[repeat(8,minmax(0,1fr))_200px]
        "
    >
        <div class="font-semibold">
            ID
        </div>

        <div class="font-semibold">
            Type
        </div>

        <div class="font-semibold">
            Preview
        </div>

        <div class="font-semibold">
            Дата публикации
        </div>

        <div class="font-semibold md:col-span-4">
            Заголовок
        </div>

        <div></div>

        @foreach($list as $record)
            <div>
                    <?= $record->id ?>
            </div>

            <div>
                    <?= $record->type ?>
            </div>

            <div>
                <img src="{{asset("images/events/600x600_{$record->image}.jpg")}}" class="max-w-12" alt=""/>
            </div>

            <div>
                    <?= $record->published_at ?>
            </div>

            <div class="md:col-span-4">
                    <?= $record->title ?>
            </div>

            <div>
                <div class="flex flex-row-reverse text-white w-full">
                    <div class="flex-none w-14">
                        <a
                            href="{{route('admin:events:delete',$record->id)}}"
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
                            href="{{route('admin:events:edit',$record->id)}}"
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

                    <div class="flex-none w-14">
                        <a
                            href="#"
                            target="_blank"
                            class="
                                    py-2 px-4 rounded-md
                                    bg-blue-950
                                    hover:bg-blue-700
                                    active:bg-gray-700
                                "
                        >
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>

                </div>
            </div>
            <hr class="md:col-span-9 last:hidden">
        @endforeach
    </div>

</div>
