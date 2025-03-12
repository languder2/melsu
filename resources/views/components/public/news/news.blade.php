<section class="main-section">
    <section class="container custom">
        <div class="page-header pt-14 mb-5 xl:mb-14">

            {{Breadcrumbs::view('vendor.breadcrumbs.news-item','news-item',$news)}}

            <h1 class="text-4xl font-bold block pb-2">
                {!! @$news->title !!}
            </h1>
            <span class="text-[var(--primary-color)]">
                <i class="bi bi-calendar2-week"></i>
                    {{$news->publication_at}}
            </span>
        </div>
    </section>

    <div class="container custom">
        <div class="content-news mb-3">
            {!! $news->news !!}
        </div>

        <div class="flex justify-between md:grid  md:grid-cols-[1fr_1fr] gap-[1px] bg-[#F1F1F1] p-[1px]">
            <div class="p-6 group/btnnews bg-white w-full">
                @if ($previousNews)
                <a href="https://melsu/news/show/{{$previousNews->id}}">
                    <div class="flex flex-row">
                        <div class="w-[80px] h-[80px] relative text-white pointer me-3">
                                    <img src="{{$previousNews->preview->thumbnail}}" alt=""
                                    class="rounded-[50%] brightness-[40%] group-hover/btnnews:brightness-[80%] transition duration-300 ease-linear object-cover h-[80px] w-[80px]">
                            <i class="bi bi-arrow-left text-4xl absolute top-[27%] left-[27%]"></i>
                        </div>
                        <div class="hidden md:flex flex-col">
                            <label class="text-sm mb-2">Предыдущая:</label>
                            <span class="font-[600] text-xs sm:text-base">
                                        Предыдущая новость
                                    </span>
                        </div>
                    </div>
                </a>
                @else
                    <a href="" class="pointer-events-none">
                        <div class="flex flex-row">
                            <div class="w-[80px] h-[80px] relative text-white pointer me-3">
                                    <img src="{{$news->preview->thumbnail}}" alt=""
                                         class="rounded-[50%] brightness-[40%] transition duration-300 ease-linear object-cover h-[80px] w-[80px]">
                                <i class="bi bi-x text-4xl absolute top-[27%] left-[27%]"></i>
                            </div>
                            <div class="hidden md:flex flex-col">
                                <label class="text-sm mb-2">Предыдущая:</label>
                                <span class="font-[600] text-xs sm:text-base">
                                        Предыдущая новость
                                    </span>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
            <div class="p-6 group/btnnews bg-white w-full">
                @if ($nextNews)
                    <a href="https://melsu/news/show/{{$nextNews->id}}">
                        <div class="flex flex-row justify-end">
                            <div class="hidden md:flex flex-col">
                                <label class="text-sm mb-2 text-end">Следующая:</label>
                                <span class="font-[600] text-xs sm:text-base">
                                            Следующая новость
                                        </span>
                            </div>
                            <div class="w-[80px] h-[80px] relative text-white pointer ms-3">
                                <img src="{{$nextNews->preview->thumbnail}}" alt=""
                                     class="rounded-[50%] brightness-[40%] group-hover/btnnews:brightness-[80%] transition duration-300 ease-linear object-cover h-[80px] w-[80px]">
                                <i class="bi bi-arrow-right text-4xl absolute top-[27%] left-[27%]"></i>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="" class="pointer-events-none">
                        <div class="flex flex-row justify-end">
                            <div class="hidden md:flex flex-col">
                                <label class="text-sm mb-2 text-end">Следующая:</label>
                                <span class="font-[600] text-xs sm:text-base">
                                        Следующая новость
                                    </span>
                            </div>
                            <div class="w-[80px] h-[80px] relative text-white pointer ms-3">
                                <img src="{{$news->preview->thumbnail}}" alt=""
                                     class="rounded-[50%] brightness-[40%] transition duration-300 ease-linear object-cover h-[80px] w-[80px]">
                                <i class="bi bi-x text-4xl absolute top-[27%] left-[27%]"></i>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
