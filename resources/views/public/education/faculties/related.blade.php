<div class="wrapper mb-4">
    <section class="container py-3 lg:py-12">
        <div class="grid grid-cols-1 gap-4">

            @foreach($division->faculties as $item)
                <a
                    href="{{$item->link}}"
                    class="
                        block
                        bg-gray-100 relative group
                        cursor-pointer
                        transition-all duration-200
                        hover:-mt-1 hover:mb-1
                        hover:shadow-md hover:shadow-black/5

                    "
                >
                    <x-html.plate-details />
                    <img
                        src="{{$item->preview->thumbnail}}"
                        alt="{{$item->name}}"
                        title="{{$item->name}}"
                        class="
                            absolute right-0 max-h-full z-10 w-1/3
                            bottom-0
                            object-contain object-right-bottom
                            transition-all duration-300
                            group-hover:drop-shadow-[0_0_3px_rgba(100,100,100,.2)]
                        "
                    />

                    <div class="relative z-30 w-2/3 p-4">
                        <h4
                            class="
                            py-2 px-4 font-semibold
                            relative
                        "

                        >
                            {{$item->name}}
                        </h4>

                        <hr class="bg-white/40 h-2px ml-4">

                        <div class="grid grid-cols-[1fr_auto] gap-2 ml-4 my-2">
                            <div>
                                Кол-во кафедр
                            </div>
                            <div class="font-semibold">
                                {{$item->departments->count() }}
                            </div>
                            <div>
                                Направлений подготовки
                            </div>
                            <div class="font-semibold">
                                {{$item->specialities->count()}}
                            </div>
                        </div>

                        <hr class="bg-white/40 h-2px ml-4">

                        <div class="my-2 ml-4 line-clamp-8">
                            {!! $item->description ?? null !!}
                        </div>

                    </div>
                </a>
            @endforeach
        </div>
    </section>
</div>
