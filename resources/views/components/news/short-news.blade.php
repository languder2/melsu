<section class="news-section mb-6">
    <div class="container custom p-2.5 xl:p-0">
        <div class="box-nav-btns">
            <div class="nav-btns">
                @if($news->count())
                    <a class="news-btn active">Новости</a>
                @endif
                @if($previews->count() && 0)
                    <a class="events-btn">Мероприятия</a>
                @endif
                @if($reports->count() && 0)
                    <a class="anons-btn">Анонсы</a>
                @endif
            </div>
            <div class="more-btns">
                @if(!empty($news))
                    <div class="btn-more-box flex items-center active">
                        <a href="{{url(route('news:show:all'))}}" class="btn-more">
                            Все новости
                        </a>
                        <a href="{{url(route('news:show:all'))}}">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </div>
                @endif
                @if(!empty($previews))
                    <div class="btn-more-box flex items-center">
                        <a href="#" class="btn-more">Все мероприятия</a>
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </div>
                @endif
                @if(!empty($reports))
                    <div class="btn-more-box flex items-center">
                        <a href="#" class="btn-more">Все анонсы</a>
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </div>
                @endif
            </div>
        </div>
        @if($news->count())
            <div class="scroll-news overflow-x-auto">
                <div class="news-main-block grid grid-cols-8 md:grid-cols-2 xl:grid-cols-4 gap-4 w-max md:w-full">
                    @foreach($news as $item)
                        <a
                            href="{{$item->link}}"
                            class="min-h-300 relative block"
                        >
                            <img
                                src="{{$item->preview->thumbnail}}"
                                alt="{{$item->preview->alt??$item->preview->name}}"
                                class="w-full h-full object-cover object-center"
                            />
                            <span class="absolute z-20 py-2 px-3 bg-base-red/80 text-white top-0 right-0 text-right">
                                {{@$item->tag->name}}
                            </span>

                            <p
                                class="
                                    flex flex-col gap-2
                                    absolute inset-x-4 bottom-4
                                    text-white
                                "
                            >
                                <span>
                                    <span class="py-2 px-3 bg-base-red/80 text-white inline-block">
                                        {{$item->publication_at}}
                                    </span>
                                </span>
                                <span class="py-2 px-3 bg-base-red/80 text-white">
                                    {{$item->title}}
                                </span>
                            </p>
                        </a>

                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
