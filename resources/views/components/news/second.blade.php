<div class="news-box">
    <a href="{!!route('news:show',$news->id)!!}" class="hover:opacity-80 transition duration-300 ease-linear">
        <div class="relative bg-white overflow-hidden">

            @if($news->preview && $news->preview->src)
                <img
                    src="{!!$news->preview->thumbnail!!}"
                    alt="{!!$news->preview->alt??$news->preview->name!!}"
                    class="object-cover object-top 2xl:h-full h-[275px] 2xl:max-h-[330px] w-full"
                >
            @elseif($news->image)
                <img
                    src="{!!$news->image!!}"
                    alt=""
                    class="object-cover object-top 2xl:h-full h-[275px] 2xl:max-h-[330px] w-full"
                >
            @endif
            <span
                class="meta-category liquid-glass border-0 text-white text-[12px] absolute top-[10px] px-5 py-3 font-[500]" style="background: rgba(0, 0, 0, 0.25);">
                <div class="liquid-glass--bend"></div>
                <div class="liquid-glass--face"></div>
                <div class="liquid-glass--edge"></div>
                <div class="liquid-glass__menus"></div>
                <div class="liquid-glass__content h-full">
                    <div class="flex lg:flex-col items-center lg:items-start justify-between gap-5 h-full">
                        <span class="relative z-10 font-bold">{{@$news->tag->name}}</span>
                    </div>
                </div>
            </span>

        </div>
        <div class="px-2.5 py-3 h-full">
            <div class="flex justify-between mb-4">
                <span class="text-[#C10F1A] font-bold text-lg">
                    {{ $news->published_at->format('d.m.Y') }}
                </span>
                <span class="text-[#CCCCCC] text-lg">
                    {{ $news->published_at->format('H:i') }}
                </span>
            </div>
            <div class="mb-3">
                <h2 class="font-semibold">
                    {!! $news->title !!}
                </h2>
            </div>
            <div class="line-clamp-3 text-[#BBBBBB]">
                    {!! $news->ShortHTML !!}
            </div>
        </div>
    </a>
</div>
