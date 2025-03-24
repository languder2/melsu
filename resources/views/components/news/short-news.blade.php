<section class="news-section mb-6">
    <div class="container custom p-2.5 xl:p-0">
        @if($news->count())

            <div class="flex justify-between items-center mb-6 flex-col sm:flex-row">
                <div class="mb-3 sm:mb-0">
                    <h2 class="text-2xl lg:text-3xl font-bold">Новости</h2>
                </div>
                <div class="flex justify-between items-center mb-3 sm:mb-0">
                    <div class="p-4 rounded-full border border-[#212121] transition duration-300 ease-linear cursor-pointer group
                    hover:border-red-900 hover:bg-red-900">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left group-hover:fill-white" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                        </svg>
                    </div>
                    <div class="flex items-center px-3">
                        <span class="font-bold">01</span>
                        <span class="font-bold px-1">/</span>
                        <span>10</span>
                    </div>
                    <div class="p-4 rounded-full border border-[#212121] transition duration-300 ease-linear cursor-pointer group
                    hover:border-red-900 hover:bg-red-900">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right group-hover:fill-white" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                        </svg>
                    </div>
                </div>
                <div class="border-none sm:border-r-4 border-red-900 sm:border-b-4 border-b-[#FAFAFA] px-3 transition duration-300 ease-linear cursor-pointer
        hover:border-b-4 hover:border-red-900">
                    <a href="{{url(route('news:show:all'))}}" class="font-semibold">Все новости</a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-0 mb-6">
                @foreach($news as $k => $item)
                    <div class="min-h-[300px] sm:min-h-auto max-h-[300px] relative group {{ $k == 0 || $k == 4 ? 'lg:col-span-2' : '' }}">
                    <a href="{{$item->link}}" alt="{{$item->preview->alt??$item->preview->name}}">
                        <img src="{{$item->preview->thumbnail}}" alt="" class="object-cover h-full w-full transition duration-300 ease-linear group-hover:opacity-80">
                        <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-[rgba(0,0,0,0.78)] from-0% via-[rgba(0,0,0,0.57)] via-50% to-transparent to-100% min-h-1/3">
                            <span class="{{ $k == 0 || $k == 4 ? 'w-2/3' : '' }} text-white [text-shadow:_0_4px_8px_#000000]">{{$item->title}}</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
