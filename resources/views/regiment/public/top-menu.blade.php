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
                    flex gap-3
                "
            >
                <img src="{{ $item->type->ico() }}" alt="{{$item->type->getFullName()}}" />
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
                    text-nowrap
                    flex gap-3
                    group
                    after:inset-x-1/2
                "
            >
                <img src="{{ $item->type->ico() }}" alt="{{$item->type->getFullName()}}" />

                <span class="opacity-40 group-hover:opacity-100 group-hover:after:inset-x-0 group-hover:after:bg-gray-700">
                    {!! $item->name !!}
                </span>
            </a>
        @endif
    @endforeach
    <a  href="{{ route('news-categories:public',['Celebration-of-the-80th-anniversary-of-Victory']) }}"
        class="
            relative pb-2 px-8
            border-b-2 font-semibold
            transition-all duration-200

            after:absolute
            after:h-2px
            after:transition-all
            after:duration-200
            after:-bottom-2px
            after:inset-x-1/2
            text-nowrap
            flex gap-3
            group
        "
    >

        <img
            src="{{ asset('img/regiments-menu-ico/celebration.svg') }}"
            alt="Празднование 80-летия Победы"
        />
        <span class="opacity-40 group-hover:opacity-100 group-hover:after:inset-x-0 group-hover:after:bg-gray-700">
            Празднование 80-летия Победы
        </span>
    </a>
</section>

