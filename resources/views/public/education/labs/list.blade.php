<section class="container pt-12 pb-12 ">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        @foreach($list as $item)
            <a
                href="{{$item->link}}"
                class="
                    block
                    bg-gray-100 relative group
                    cursor-pointer
                    transition-all duration-200
                    hover:-mt-1 hover:mb-1
                    hover:shadow-md
                    hover:shadow-black/20
                    group
                "
            >

                <x-html.plate-details />



                @if($item->preview->name !== 'preview')
                    <img
                        src="{{$item->preview->thumbnail}}"
                        alt="{{$item->preview->name}}"
                        title="{{$item->preview->name}}"
                        class="
                            absolute right-8 h-full z-10 w-1/3 bottom-0
                            object-contain object-right-bottom
                            transition-all duration-300
                        "
                    >
                @endif

                <div class="relative z-30 w-2/3 p-4">
                    <h4
                        class="
                            py-2 px-4 font-semibold
                            relative
                        "

                    >

                        {!! $item->name !!}
                    </h4>

                    <hr class="bg-white/40 h-2px ml-4">

                    <div class="my-2 ml-4 line-clamp-8">
                        {!! $item->description ?? null !!}
                    </div>

                </div>
            </a>
        @endforeach
    </div>
</section>



