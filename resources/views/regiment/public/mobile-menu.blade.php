<section
    class="grid gap-4 grid-cols-1 sm:grid-cols-3 lg:hidden text-lg font-semibold text-center"
>
    @foreach($menu as $item)
        @if($item->type === $type)
            <span
                class="text-base-red"
            >
                {{ $item->name }}
            </span>
        @else
            <a
                href="{{ $item->link }}"
                class="transition-all duration-500 hover:text-base-red"
            >
                {{ $item->name }}
            </a>
        @endif
    @endforeach
</section>
