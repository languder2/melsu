<div class="news-box">
    <a href="{!!route('news:show',$news->id)!!}" class="group transition duration-300 ease-linear">
        <div class="relative overflow-hidden mx-1 p-1 pb-2">

            <img
                src="{!!$news->preview->thumbnail!!}"
                alt="{!!$news->preview->alt??$news->preview->name!!}"
                class="object-cover object-center aspect-video w-full group-hover:drop-shadow-md border border-transparent group-hover:border-white duration-300 group-hover:opacity-80"
            >

            @if($news->tag)
                <div
                    class="meta-category liquid-glass border-0 text-white text-sm absolute top-3 px-5 py-3 font-semibold bg-opacity-25 bg-black/25">
                    <div class="liquid-glass--bend"></div>
                    <div class="liquid-glass--face"></div>
                    <div class="liquid-glass--edge"></div>
                    <div class="liquid-glass__menus"></div>
                    <div class="liquid-glass__content h-full">
                        <div class="flex lg:flex-col items-center lg:items-start justify-between gap-5 h-full">
                            <span class="relative z-10 font-bold">{{ $news->tag->name }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="px-2 py-3 h-full flex flex-col gap-3">
            <div class="flex justify-between">
                <span class="text-red-700 font-bold text-lg">
                    {{ $news->published_at->format('d.m.Y') }}
                </span>
                <span class="text-gray-400 text-lg">
                    {{ $news->published_at->format('H:i') }}
                </span>
            </div>
            <div>
                <h2 class="font-semibold">
                    {!! $news->title !!}
                </h2>
            </div>
            <div class="line-clamp-3 text-gray-400">
                {!! $news->ShortHTML !!}
            </div>
        </div>
    </a>
</div>
