@props([
    'news'  => collect()
])
@if($news->isNotEmpty())
<h4 class="font-semibold text-xl">
    Новости
</h4>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
    @foreach($news as $item)
        <div class="shadow-md border">
            <a href="{{ $item->link }}" class="block relative aspect-video">

                <img src="{{ $item->preview->thumbnail }}" class="w-full object-cover box-border aspect-video" alt="">

                <x-html.glass
                    absolute
                    top="2"
                    left="2"
                >
                    {{ $item->published_at->format('d') }}
                    {{ __('month.rod-m-'.$item->published_at->format('m')) }}
                    {{ $item->published_at->format('Y') }}
                </x-html.glass>

                <div
                    class="
                                    absolute inset-x-0 bottom-0 drop-shadow-white p-3 font-semibold
                                    text-white
                                    bg-gradient-to-t
                                    from-black
                                    text-shadow-md text-shadow-black
                                "
                >
                    {!! $item->title !!}
                </div>
            </a>
        </div>
    @endforeach
</div>
@endif
