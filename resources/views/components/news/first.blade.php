<div class="first-news-box col-span-2 row-span-2 border border-[#e5e7eb] sm:max-h-[758px]">
    <a href="{{route('news:show',$news->id)}}">
        <div class="img-news-box relative">

            @if($news->preview && $news->preview->src)
                <img src="{{$news->preview->src}}" alt="{{$news->preview->alt??$news->preview->name}}"
                     class="object-cover object-top max-h-[353px] w-full">
            @elseif($news->image)
                <img src="{{$news->image}}" alt=""
                     class="object-cover object-top max-h-[353px] w-full">
            @endif

            <span
                class="meta-category bg-[var(--primary-color)] text-white text-[12px] absolute top-[10px] py-[3px] px-[7px] font-[500]">
                {{@$news->tag->name}}
            </span>
        </div>
        <div class="bg-[var(--primary-color)] p-5 text-white lg:max-h-[404px] h-auto lg:h-full">
            <div class="grid grid-cols-[70%_29%] mb-3">
                <h2 class="text-3xl font-[700]">
                    {!! $news->title !!}
                </h2>
                <div class="text-end">
                    <span class="text-[12px] font-[500]">
                        <i class="bi bi-calendar2-week"></i>
                        {{$news->published_at}}
                    </span>
                </div>
            </div>
            <div>
                <p class="line-clamp-10">
                    {!! $news->full !!}
                </p>
            </div>
        </div>
    </a>
</div>
