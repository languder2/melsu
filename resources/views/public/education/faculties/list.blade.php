<section class="container pt-12 pb-12 ">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        @foreach($list as $item)
            <a
                href="{{route('public:education:faculty',[$item->code??$item->id])}}"
                class="
                    block
                    bg-gray-100 relative group
                    cursor-pointer
                    transition-all duration-200
                    hover:-mt-1 hover:mb-1
{{--                    hover:drop-shadow-[3px_3px_5px_rgba(100,100,100,.6)]--}}
                "
            >

                <x-html.plate-details />

                <img
                    src="{{$item->preivew->thumbnail}}"
                    alt="{{$item->name}}"
                    title="{{$item->name}}"
                    class="
                        absolute right-8 max-h-full z-10 w-1/3
                        bottom-0
                        object-contain object-right-bottom
                        transition-all duration-300
                        grayscale-100 group-hover:grayscale-0
                        group-hover:drop-shadow-[0_0_3px_rgba(100,100,100,1)]
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

                    <div class="my-2 ml-4 line-clamp-8">
                        {!! $item->description ?? null !!}
                    </div>

                </div>
            </a>
        @endforeach
    </div>
</section>



