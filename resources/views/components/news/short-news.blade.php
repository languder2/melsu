<section class="news-section">
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
        <div class="relative min-h-[380px] mb-5">
            @if(!empty($news))
                <div class="elem news-block-box active">
                    <div class="news-block">
                        @foreach($news as $item)
                            <div class="news-box">
                                <div class="category-box">
                                    <a href="{{$item->link}}">
                                        {{@$item->tag->name}}
                                    </a>
                                </div>
                                <a href="{{$item->link}}">
                                    <img src="{{$item->photo}}" alt="">
                                </a>
                                <div class="descrip-meta-wrap">
                                    <div class="meta-box">
                                        <a href="{{$item->link}}">
                                            {{$item->publication_at}}
                                        </a>
                                    </div>
                                    <div class="description-box">
                                        <h3>
                                            {{$item->title}}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
