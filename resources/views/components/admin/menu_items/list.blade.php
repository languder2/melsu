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
                md:grid-cols-[50px_repeat(5,minmax(0,1fr))_200px]
            "
        >
            <div class="font-semibold text-right">
                ID
            </div>

            <div class="font-semibold md:col-span-2">
                Название
            </div>

            <div class="font-semibold">
                Страница
            </div>

            <div class="font-semibold">
                Link
            </div>

            <div class="font-semibold">
                Parent
            </div>

            <div></div>

            @foreach($category->menu as $record)
                <div class="text-right">
                    {{$record->id}}
                </div>

                <div class="md:col-span-2">
                    @if(!is_null($record->parent_id))
                        <span class="inline-block ms-3"></span>
                        <x-html.arrow-right/>
                    @endif

                    {{$record->name}}
                </div>

                <div>
                    {{@$record->page->name}}
                </div>

                <div>
                    @if(Route::has($record->route))
                        {{url(route($record->route))}}
                    @elseif(!empty($record->page->alias))
                        {{url($record->page->alias)}}
                    @else
                        {{$record->link}}
                    @endif
                </div>

                <div>
                    {{@$record->parent->name}}
                    {{$record->grp}}
                </div>

                <div>
                    <div class="flex flex-row-reverse text-white w-full">
                        <div class="flex-none w-14">
                            <a
                                href="{{route('admin:menu-items:delete',$record->id)}}"
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
                                href="{{route('admin:menu-items:edit',$record->id)}}"
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
