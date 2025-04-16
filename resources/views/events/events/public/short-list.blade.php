<section class="container custom p-2.5 xl:p-0">
    <div class="flex flex-col md:flex-row gap-2 justify-between items-center">
        <h3 class="font-semibold text-2xl lg:text-3xl py-2">
            Мероприятия
        </h3>
            <a
                href="{{ route('public:events:list') }}"
                class="
                    font-semibold md:px-4 md:py-2

                    md:border-r-4 md:border-r-base-red
                    border-b-4 border-b-base-red/0 hover:border-b-base-red
                "
            >
                Все мероприятия
            </a>
    </div>
    <div class="py-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-3 gap-y-6">
        @foreach($list as $item)
            <div class="flex gap-3 items-start">
                <a
                    href="{{route('public:event:show',$item)}}"
                    class="
                        flex flex-col gap-1 leading-none text-center px-5 py-2 rounded-md text-white
                        bg-base-red hover:bg-red-700
                    "
                >
                    <p class="text-[.625rem] uppercase">
                        {{__("month.short-{$item->month}")}}
                    </p>

                    <p class="text-[1.5rem] p-px font-semibold">
                    {{ $item->day }}
                    </p>

                    <p class="text-[.75rem]">
                        {{ $item->year }}
                    </p>
                </a>
                <a
                    href="{{route('public:event:show',$item)}}"
                    class="flex-1 hover:underline"
                >
                    {!! $item->title !!}
                </a>
            </div>
        @endforeach
    </div>
</section>
