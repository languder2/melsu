<div class="bg-white rounded-md p-4 mb-4">

    <div class="grid grid-cols-1 md:grid-cols-7 gap-x-4 gap-y-4">
        <div class="font-semibold">
            ID
        </div>

        <div class="font-semibold">
            Дата публикации
        </div>

        <div class="font-semibold col-span-4">
            Заголовок
        </div>

        <div></div>

        @foreach($list as $record)
            <div>
                    <?=$record->id?>
            </div>

            <div>
                    <?=$record->publication_at?>
            </div>

            <div class="col-span-4">
                    <?=$record->title?>
            </div>

            <div>
                <div class="flex flex-row-reverse text-white">
                    <div class="flex-none w-14">
                        <a
                            href="{{route('admin:news:delete',$record->id)}}"
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
                            href="{{route('admin:news:edit',$record->id)}}"
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
            <hr class="md:col-span-7 last:hidden">
        @endforeach
    </div>

</div>
