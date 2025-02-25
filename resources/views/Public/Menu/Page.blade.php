@if($menu->items->count())
    @foreach($menu->items as $item)
        @if(!$item->subs->count()) @continue @endif
        <h3
            class="
                text-6 font-semibold
                mt-3 px-4 py-2
            "
        >
            {{$item->name}}
        </h3>

        <div
            class="
                grid gap-2 grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 p-4
            "
        >
            @foreach($item->subs as $sub)
                <a
                    href="{{$sub->link}}"
                    class="
                        relative block
                        hover:-mt-2px hover:mb-2px
                        transition-all duration-300
                        hover:shadow-lg hover:shadow-cyan-900/50
                        group
                    "
                >
                    <div
                        class="
                            flex absolute inset-4 z-30 justify-between items-center
                            text-white text-2xl
                            group-hover:drop-shadow-[0_0_3px_rgba(255,255,255,1)]
                        "
                    >
                        <div>
                            {{$sub->name}}
                        </div>
                        <div class="text-2xl">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 13L13 1M13 1H1M13 1V13" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                    <img
                        src="{{$sub->preview->thumbnail}}"
                        alt="{{$item->name}}"
                        title="{{$item->name}}"
                        class="object-cover h-26 w-full"
                    >
                </a>
            @endforeach
        </div>



    @endforeach
@endif

