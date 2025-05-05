<section
    class="sm:grid-cols-3 hidden lg:flex flex-row gap-4 flex-wrap text-2xl font-semibold text-left max-2xl:pe-48 pt-6"
>
    @foreach($menu as $item)
        @if($item->type === $type)
            <a  href="{{ $item->link }}"
                class="
                    relative pb-2 px-8
                    border-b-2 font-semibold
                    transition-all duration-200

                    after:absolute
                    after:h-2px
                    after:transition-all
                    after:duration-200
                    after:-bottom-2px
                    after:inset-x-0 after:bg-gray-700
                    text-nowrap
                "
            >
                {!! $item->name !!}
            </a>
        @else
            <a  href="{{ $item->link }}"
                class="
                    relative pb-2 px-8
                    border-b-2 font-semibold
                    transition-all duration-200

                    after:absolute
                    after:h-2px
                    after:transition-all
                    after:duration-200
                    after:-bottom-2px
                    opacity-40 hover:opacity-100 after:inset-x-1/2 hover:after:inset-x-0 hover:after:bg-gray-700
                    text-nowrap
                "
            >
                {!! $item->name !!}
            </a>
        @endif
    @endforeach
    <a  href="#"
        class="
            relative pb-2 px-8
            border-b-2 font-semibold
            transition-all duration-200

            after:absolute
            after:h-2px
            after:transition-all
            after:duration-200
            after:-bottom-2px
            opacity-40 hover:opacity-100 after:inset-x-1/2 hover:after:inset-x-0 hover:after:bg-gray-700
            text-nowrap
        "
    >
        Празднование 80-летия Победы
    </a>
</section>

