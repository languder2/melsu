<h4 class="text-2xl font-semibold">
    Мероприятия
</h4>

<div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    @foreach($list as $item)
        <a
            href="{{ $item->link }}"
            class="h-100 relative bg-cover block drop-shadow-md rounded-md cursor-pointer hover:-mt-2px hover:mb-2px duration-200"
           style="background-image: url('{{ $item->preview->src }}')"
        >
            <div class="absolute inset-x-3 bottom-3 backdrop-blur-3xl bg-black/20 text-white px-4 py-3">
                {{ $item->title }}
            </div>
        </a>
    @endforeach

</div>

