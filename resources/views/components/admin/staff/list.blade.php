<div class="bg-white rounded-md p-4 mb-4">

    <div
        class="
            grid gap-4 items-center
            grid-cols-1
            md:grid-cols-[repeat(2,auto)_repeat(3,minmax(0,1fr))_auto]
        "
    >
        <div class="font-semibold">
            ID
        </div>

        <div class="font-semibold">
            Фото
        </div>

        <div class="font-semibold">
            Должность
        </div>

        <div class="font-semibold">
            ФИО
        </div>

        <div class="font-semibold">
            Links
        </div>

        <div></div>

        @foreach($list as $record)
            <div>
                    <?= $record->id ?>
            </div>

            <div class="text-center">
                @if($record->avatar)
                    <img
                        src="{{optional($record->avatar)->thumbnail}}"
                        alt="{{optional($record->avatar)->name}}"
                        class="h-20 inline-block"
                    />
                @elseif($record->photo)
                    <img
                        src="{{asset("images/photo/200x200_{$record->photo}.jpg")}}"
                        alt=""
                        class="h-20 inline-block"
                    />
                @else
                    <img
                        src="{{Storage::url('images/placeholder.png')}}"
                        alt="placeholder"
                        class="h-20 inline-block"
                    />
                @endif
            </div>

            <div>
                    <?= $record->post ?>
            </div>

            <div>
                    <?= $record->lastname ?>
                    <?= $record->firstname ?>
                    <?= $record->middle_name ?>
            </div>

            <div>
                {{url(route('public:staff:show',$record->id))}}
                @if(!empty($record->alias))
                    {{url(route('public:staff:show',$record->alias))}}
                @endif
            </div>

            <div>
                <div class="flex flex-row-reverse text-white w-full">
                    <div class="flex-none w-14">
                        <a
                            href="{{route('admin:staff:delete',$record->id)}}"
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
                            href="{{route('admin:staff:edit',$record->id)}}"
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
                            href="{{route('public:staff:show',$record->id)}}"
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
            <hr class="md:col-span-6 last:hidden">
        @endforeach
    </div>

    <hr class="my-4">

    {{@$list->links()}}
</div>
