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

        <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr] gap-[1px] bg-[#F1F1F1] p-[1px]">
            <div class="p-6 group/btnnews bg-white">
                <a href="#">
                    <div class="flex flex-row">
                        <div class="w-[80px] h-[80px] relative text-white pointer me-3">
                            <img src="../assets/img/ph-news.jpg" alt=""
                                 class="rounded-[50%] brightness-[40%] group-hover/btnnews:brightness-[80%] transition duration-300 ease-linear">
                            <i class="bi bi-arrow-left text-4xl absolute top-[27%] left-[27%]"></i>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-sm mb-2">Предыдущая:</label>
                            <span class="font-[600] text-xs sm:text-base">
                                        Предыдущая новость
                                    </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="p-6 group/btnnews bg-white">
                <a href="#">
                    <div class="flex flex-row justify-end">
                        <div class="flex flex-col">
                            <label class="text-sm mb-2 text-end">Следующая:</label>
                            <span class="font-[600] text-xs sm:text-base">
                                        Следующая новость
                                    </span>
                        </div>
                        <div class="w-[80px] h-[80px] relative text-white pointer ms-3">
                            <img src="../assets/img/ph-news.jpg" alt=""
                                 class="rounded-[50%] brightness-[40%] group-hover/btnnews:brightness-[80%] transition duration-300 ease-linear">
                            <i class="bi bi-arrow-right text-4xl absolute top-[27%] left-[27%]"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
