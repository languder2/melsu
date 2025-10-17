<div class="news-box border border-[#e5e7eb] max-h-[339px] lg:max-h-[367px]">
    <a href="{{route('public:event:show',$item->id)}}">
        <div class="box-photo-news min-h-[139px] bg-white overflow-hidden">

            @if($item->preview && $item->preview->src)
                <img
                    src="{{$item->preview->thumbnail}}"
                    alt="{{$item->preview->alt??$item->preview->name}}"
                    class="object-cover max-h-[139px] w-full"
                >
            @elseif($item->image)
                <img
                    src="{{$item->image}}"
                    alt=""
                    class="object-cover max-h-[139px] w-full"
                >
            @endif


        </div>
        <div class="descrip-box-news bg-white text-[var(--primary-color)] lg:min-h-[228px] xl:max-h-[228px]">
            <div class="descrip-wrapper p-5 max-h-[198px] min-h-[198px] lg:max-h-[228px]">
                <div class="grid grid-cols-[1fr] mb-3 p-[-20px] relative">
                    <span
                        class="meta-category bg-[var(--primary-color)] absolute text-white text-[12px] left-[-20px] py-[3px] px-[7px] font-[500]">
                        {{@$item->tag->name}}
                    </span>
                    <div class="text-end">
                                    <span class="text-[12px] font-[500]">
                                        <i class="bi bi-calendar2-week"></i>
                                        {{$item->published_at}}
                                    </span>
                    </div>
                </div>
                <div class="mb-6">
                    <h3 class="text-lg font-[700] line-clamp-3 max-h-[84px]">
                        {{$item->title}}
                    </h3>
                </div>
                <div class="description-news line-clamp-3 max-h-[72px]">
                    {!! $item->ShortHTML !!}
                </div>
            </div>
        </div>
    </a>
</div>
