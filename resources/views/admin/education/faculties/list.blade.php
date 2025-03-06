{{--<div class="bg-white rounded-md p-4 mb-4">--}}

{{--    <div--}}
{{--        class="--}}
{{--            grid gap-4 items-center--}}
{{--            grid-cols-1--}}
{{--            md:grid-cols-[repeat(7,minmax(0,1fr))_200px]--}}
{{--        "--}}
{{--    >--}}
{{--        <div class="font-semibold">--}}
{{--            ID--}}
{{--        </div>--}}

{{--        <div class="font-semibold">--}}
{{--            alias--}}
{{--        </div>--}}

{{--        <div class="font-semibold md:col-span-2">--}}
{{--            Наименование--}}
{{--        </div>--}}

{{--        <div class="font-semibold md:col-span-2">--}}
{{--            Ссылка--}}
{{--        </div>--}}

{{--        <div class="font-semibold">--}}
{{--            Departments--}}
{{--        </div>--}}

{{--        <div></div>--}}

{{--        @foreach($list as $record)--}}
{{--            <div>--}}
{{--                {{$record->id}}--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                <img src="{{$record->logo->src}}" alt="{{$record->name}}" class="h-20" />--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                {{$record->code}}--}}
{{--            </div>--}}

{{--            <div class="md:col-span-2">--}}
{{--                {{$record->name}}--}}
{{--            </div>--}}

{{--            <div class="md:col-span-2">--}}
{{--                {{url($record->code)}}--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                {{$record->departments->count()}}--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                <div class="flex flex-row-reverse text-white w-full">--}}
{{--                    <div class="flex-none w-14">--}}
{{--                        <a--}}
{{--                            href="{{route('admin:education:faculty:delete',$record->id??0)}}"--}}
{{--                            class="--}}
{{--                                py-2 px-4 rounded-md--}}
{{--                                bg-red-950--}}
{{--                                hover:bg-red-700--}}
{{--                                active:bg-gray-700--}}
{{--                            "--}}
{{--                        >--}}
{{--                            <i class="fas fa-trash w-4 h-4"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="flex-none w-14">--}}
{{--                        <a--}}
{{--                            href="{{route('admin:education:faculty:edit',$record->id??0)}}"--}}
{{--                            class="--}}
{{--                                py-2 px-4 rounded-md--}}
{{--                                bg-green-950--}}
{{--                                hover:bg-green-700--}}
{{--                                active:bg-gray-700--}}
{{--                            "--}}
{{--                        >--}}
{{--                            <i class="far fa-edit w-4 h-4"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <hr class="md:col-span-8 last:hidden">--}}
{{--        @endforeach--}}
{{--    </div>--}}

{{--</div>--}}


<div class="flex flex-wrap gap-3">
    @foreach($list as $item)
        <div
            class="
                gallery-item
                relative rounded-lg
                transition-all duration-200
                hover:-mt-2px
                hover:mb-2px
                hover:drop-shadow-[3px_5px_5px_rgba(0,0,0,.5)]
                select-none
                min-w-20
                bg-gray-700
            "
        >
            <img
                src="{{$item->logo->thumbnail}}"
                alt="{{$item->name}}"
                class="
                    h-96
                    relative rounded-lg
                    transition-all duration-300
                    object-contain
                "
            >

            <div
                class="
                    absolute inset-0 end-0 flex flex-col
                    items-end
                "
            >
                <div class="flex justify-between w-full">
                    <div class="m-3 mb-0">
                        <a
                            href="#"
                            class="
                                block bg-stone-100 p-1 w-[4ch]
                                rounded-lg text-center
                                hover:bg-blue-900 hover:text-white
                            "
                        >
                            {{$item->departments->count()}}
                        </a>
                    </div>
                    <x-html.blocks.check-button
                        onclick="Actions.ToggleShow(this,'{{route('gallery-toggle-show',$item->id)}}')"
                        :checked="$item->show"
                    >
                        <i class="fas fa-toggle-on hidden text-green-700 group-has-checked:block"></i>
                        <i class="fas fa-toggle-off block text-red-700 group-has-checked:hidden"></i>
                    </x-html.blocks.check-button>
                </div>

                <div class="flex justify-between w-full">

                    <div class="m-3 mb-0">
                        <a
                            href="#"
                            class="
                                inline-block bg-stone-100 p-1 w-[4ch]
                                rounded-lg text-center
                                hover:bg-blue-900 hover:text-white
                            "
                        >
                            {{$item->specialities->count()}}
                        </a>
                    </div>

                    <x-html.blocks.a-button
                        hoverColor="text-blue-700"
                        :href="route('admin:education:faculty:edit',$item->id)"
                    >
                        <i class="fas fa-pencil-alt"></i>
                    </x-html.blocks.a-button>

                </div>


                <span class="flex-grow-5"></span>

                <x-html.blocks.a-button
                    hoverColor="text-red-700"
                    onclick="Actions.DeleteItem(this.closest('.gallery-item'),'{{route('gallery-delete',$item->id)}}')"
                    DeleteItem
                >
                    <i class="fas fa-recycle"></i>
                </x-html.blocks.a-button>


                <x-html.blocks.bottom-header>
                    <div>
                        #{{$item->id}}
                    </div>

                    <div class="border-r border-r-stone-50/30"></div>

                    <div class="text-right flex-1">
                        {{$item->name}}
                    </div>
                </x-html.blocks.bottom-header>
            </div>
        </div>
    @endforeach
</div>
