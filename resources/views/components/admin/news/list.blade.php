<div class="bg-white rounded-md p-4 mb-4">

    <div
        class="
            grid gap-4 items-center
            grid-cols-1
            md:grid-cols-[auto_auto_auto_repeat(4,minmax(0,1fr))_auto]
        "
    >
        <div class="font-semibold">
            ID
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

            <div class="text-center">
                @if($record->preview && $record->preview->thumbnail)
                    <img src="{{$record->preview->thumbnail}}" class="h-10 inline-block" alt=""/>
                @elseif($record->image)
                    <img src="{{$record->image}}" class="h-10  inline-block" alt=""/>
                @endif
            </div>

            <div>
                    <?= $record->publication_at ?>
            </div>

            <div class="md:col-span-4">
                    <?= $record->title ?>
            </div>

            <div>
                <div class="flex flex-row-reverse text-white w-full">
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
                            href="{{route('news:show',$record->id)}}"
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
            <hr class="md:col-span-8 last:hidden">
        @endforeach
    </div>

</div>
