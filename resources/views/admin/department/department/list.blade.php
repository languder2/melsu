<div class="bg-white rounded-md p-4 mb-4">

    <div
        class="
            grid gap-4 items-center
            grid-cols-1
            md:grid-cols-[auto_repeat(2,minmax(0,1fr))_auto]
        "
    >
        <div class="font-semibold">
            ID
        </div>

        <div class="font-semibold">
            Отдел
        </div>

        <div class="font-semibold">
            Parent
        </div>

        <div></div>

        @foreach($list as $record)
            <div class="text-right">
                {{$record->id}}
            </div>

            <div>
                {{$record->name}}
            </div>

            <div>
                {{optional($record->parent)->name}}
            </div>

{{--            <div>--}}
{{--                @if(!empty($record->alias))--}}
{{--                    {{url(route('public:department:show',$record->alias))}}--}}
{{--                @else--}}
{{--                    {{url(route('public:department:show',$record->id))}}--}}
{{--                @endif--}}
{{--            </div>--}}

            <div>
                <div class="flex flex-row-reverse text-white w-full">
                    <div class="flex-none w-14">
                        <a
                            href="{{route('admin:department:delete',$record->id)}}"
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
                            href="{{route('admin:department:edit',$record->id)}}"
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
            <hr class="md:col-span-4 last:hidden opacity-20">

            @if($record->subs)
                @foreach($record->subs as $record)
                    <div class="text-right">
                        {{$record->id}}
                    </div>

                    <div class="flex items-center">

                        <div class="mx-4">
                            @if($record->parent_id)
                                <i class="fas fa-level-up-alt rotate-90"></i>
                            @endif
                        </div>

                        <div class="flex-1">
                            {{$record->name}}
                        </div>
                    </div>

                    <div>
                        {{optional($record->parent)->name}}
                    </div>

                    <div>
                        <div class="flex flex-row-reverse text-white w-full">
                            <div class="flex-none w-14">
                                <a
                                    href="{{route('admin:department:delete',$record->id)}}"
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
                                    href="{{route('admin:department:edit',$record->id)}}"
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

                    <hr class="md:col-span-4 last:hidden opacity-20">
                @endforeach
            @endif
        @endforeach
    </div>

</div>
