@if($list->count())
    <div class="flex flex-col gap-4 mt-6">
        <h3 class="font-semibold text-2xl">
            Новости
        </h3>

        <div class="grid gap-3 grid-cols-1 lg:grid-cols-3">
            @foreach($list as $news)

                <a
                    href="{{ $news->link }}"
                    class="relative"
                >
                    <img
                        src=" {{ $news->preview->thumbnail }}"
                        alt=""
                        class="w-full h-72 object-top object-cover"
                    >

                    <div
                        class="
                            absolute inset-x-2 bottom-2
                            p-3 bg-indigo-950/20 rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100
                            drop-shadow-md drop-shadow-gray-100
                            text-white
                            [text-shadow:_0_4px_8px_#000000]
                        "
                    >
                        {!! $news->title !!}
                    </div>
                </a>
            @endforeach
        </div>

    </div>
@endif
