<div class="flex flex-col gap-4">
    <h3 class="font-semibold text-2xl">
        Новости
    </h3>

    <div class="grid gap-3 grid-cols-1 lg:grid-cols-3">
        @foreach($list as $news)

            <a
                href="#"
                class="relative"
            >
                <img
                    src=" {{ $news->preview->thumbnail }}"
                    alt=""
                    class="w-full h-72 object-top object-cover"
                >

                <div
                    class="
                        absolute inset-x-0 bottom-0 p-3 bg-gradient-to-t from-[rgba(0,0,0,0.78)]
                        from-0% via-[rgba(0,0,0,0.57)] via-50% to-transparent to-100% min-h-1/3
                        text-white [text-shadow:_0_4px_8px_#000000]
                        flex items-center
                    "
                >
                    {!! $news->title !!}
                </div>
            </a>
        @endforeach
    </div>

</div>

@dump($list)
