<div class="flex flex-col py-1">
    @foreach($info->getMenu() as $item)
        <a
            href="{{ $item->href }}"
            @class([
                "
                    px-6 py-3
                    hover:bg-white
                    hover:text-black
                ",
                $item->active ? "pointer-events-none bg-stone-100 text-black" : "text-gray-100"
            ])
        >
            {{ $item->label }}
        </a>
    @endforeach
    @if(auth()->check())
        <a
            href="{{ route('info:education:summary') }}"
            @class([
                "
                    px-6 py-3
                    hover:bg-white
                    hover:text-black
                    text-gray-100
                ",
            ])
        >
            Образование. Сводная
        </a>
        @endif
</div>
