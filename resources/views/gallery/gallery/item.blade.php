<a
    href="{{route('public:gallery:show',$item->code)}}"
    class="
        gallery-item
        relative rounded-lg
        transition-all duration-200
        hover:-mt-2px
        hover:mb-2px
        hover:drop-shadow-[3px_5px_5px_rgba(0,0,0,.5)]
        select-none
    "
>
    <img
        src="{{$item->preview}}"
        alt="{{$item->name}}"
        class="
            h-80
            relative rounded-lg
            transition-all duration-300
            object-cover
            w-full
"
    >
    <div class="absolute inset-x-0 bottom-0">
        <x-html.blocks.bottom-header>
            <span>
                {{str_pad($item->images->count(), 3, '0', STR_PAD_LEFT)}}
            </span>

            <span class="border-r border-r-stone-50/30"></span>

            <span class="text-right flex-1">
                {{$item->name}}
            </span>
        </x-html.blocks.bottom-header>
    </div>
</a>
