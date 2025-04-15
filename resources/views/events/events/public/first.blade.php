<div class="first-news-box col-span-2 row-span-2 border border-[#e5e7eb] sm:max-h-[758px] xl:max-w-2xl">
    <a href="{{route('public:event:show',$item->id)}}">
        <div class="img-news-box xl:max-w-[660px] sm:max-h-[353px] relative">

            @if($item->preview && $item->preview->src)
                <img src="{{$item->preview->src}}" alt="{{$item->preview->alt??$item->preview->name}}"
                     class="object-cover max-h-[353px] w-full">
            @elseif($item->image)
                <img src="{{$item->image}}" alt=""
                     class="object-cover max-h-[353px] w-full">
            @endif

            <span
                class="meta-category bg-[var(--primary-color)] text-white text-[12px] absolute top-[10px] py-[3px] px-[7px] font-[500]">
                {{@$item->tag->name}}
            </span>
        </div>
        <div class="bg-[var(--primary-color)] p-5 text-white lg:max-h-[404px] h-auto lg:h-full">
            <div class="grid grid-cols-[70%_29%] mb-3">
                <h2 class="text-3xl font-[700]">
                    {{$item->title}}
                </h2>
                <div class="text-end">
                    <span class="text-[12px] font-[500]">
                        <i class="bi bi-calendar2-week"></i>
                        {{$item->published_at}}
                    </span>
                </div>
            </div>
            <div>
                <p class="line-clamp-10">
                    {!! $item->full !!}
                </p>
            </div>
        </div>
    </a>
</div>
