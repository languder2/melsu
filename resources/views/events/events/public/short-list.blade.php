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
    <div class="py-4">
        @foreach($list as $item)
            {{__("month.$item->month")}}
            @dump($item->year)
            @dump($item->month)
            @dump($item->day)
        @endforeach
    </div>
</section>
