<section class="container pt-12 pb-12 ">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        @foreach($list as $item)
            <div
                class="
                    block
                    bg-gray-100 relative group
                    cursor-pointer
                    transition-all duration-200
                    hover:-mt-1 hover:mb-1
{{--                    hover:drop-shadow-[3px_3px_5px_rgba(100,100,100,.6)]--}}
                "
            >

                <a
                    href="{{route('public:education:faculty',[$item->code??$item->id])}}"
                    class="
                        opacity-0
                        absolute z-50 inset-0
                        transition-all duration-200
                        group-hover:opacity-100
                    "
                >
                    <span class="absolute bottom-0 right-0 p-4 bg-base-red text-white">
                        подробнее
                        <i class="fas fa-arrow-right ml-2"></i>
                    </span>
                </a>
                <img
                    src="{{$item->logo->thumbnail}}"
                    alt="{{$item->name}}"
                    title="{{$item->name}}"
                    class="
                        absolute inset-y-0 right-8 max-h-full z-10 w-1/3
                        object-contain object-right grayscale-100 group-hover:grayscale-0 transition-all duration-300
                    "
                >

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
                            {{$item->departments->count() ?? null}}
                        </div>
                        <div>
                            Направлений подготовки
                        </div>
                        <div class="font-semibold">
                            {{$item->specialities->count() ?? null}}
                        </div>
                    </div>

                    <hr class="bg-white/40 h-2px ml-4">

                    <div class="my-2 ml-4 ">
                        {{$item->description ?? 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aut beatae dolores, doloribus ducimus earum eveniet laudantium magnam numquam odio perspiciatis placeat porro praesentium, quas tempore veniam vero. Eveniet, explicabo? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur cumque'}}
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</section>



