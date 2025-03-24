<section class="news-section mb-6">
    <div class="container custom p-2.5 xl:p-0">
        @if($news->count())

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl lg:text-3xl font-bold">Новости</h2>
                </div>
                <div class="border-r-4 border-red-900 border-b-4 border-b-[#FAFAFA] px-3 transition duration-300 ease-linear cursor-pointer
        hover:border-b-4 hover:border-red-900">
                    <a href="{{url(route('news:show:all'))}}" class="font-semibold">Все новости</a>
                </div>
            </div>


            <div class="grid grid-cols-4 mb-6">
                @foreach($news as $k => $item)
                    <div class="max-h-[300px] relative group {{ $k == 0 || $k == 4 ? 'col-span-2' : '' }}">
                    <a href="{{$item->link}}" alt="{{$item->preview->alt??$item->preview->name}}">
                        <img src="{{$item->preview->thumbnail}}" alt="" class="object-cover h-full w-full transition duration-300 ease-linear group-hover:opacity-80">
                        <span class="absolute bottom-3 left-3 right-3 {{ $k == 0 || $k == 4 ? 'w-2/3' : '' }} text-white [text-shadow:_0_4px_8px_#000000]">{{$item->title}}</span>
                    </a>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
