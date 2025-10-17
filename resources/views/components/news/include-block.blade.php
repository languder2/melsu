<div class="grid md:grid-cols-2 2xl:grid-cols-[60%_auto] gap-5 max-w-base-container mx-auto">
    <div class="flex flex-col gap-7">
        <div class="flex items-center gap-7">
            <h2 class="text-normal 2xl:text-xl font-bold">Новости</h2>
            <a href="{{ url('news') }}" class="text-[#CCCCCC] group flex items-center gap-2 hover:text-[#C10F1A] transition duration-300 ease-linear">
                Все новости
                <span>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.33398 3.33398H16.6673M16.6673 3.33398V16.6673M16.6673 3.33398L3.33399 16.6673" stroke="#CCCCCC" class="group-hover:stroke-[#C10F1A] transition duration-300 ease-linear" stroke-width="2"/>
                                    </svg>
                                </span>
            </a>
        </div>
        <div class="grid md:grid-cols-2 gap-5">
            @foreach($news as $item)
                <div class="@if($loop->first) sm:col-span-2 @endif">
                    <a href="{{ $item->link }}" class="h-100 block relative ">

                        <img src="{{ $item->preview->thumbnail }}" class="w-full h-100 object-cover box-border" alt="">
                        <div class="flex items-center absolute top-5 left-5 w-ful p-3 rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100 bg-indigo-700/20">
                            <h3 class="text-white font-semibold [text-shadow:3px_1px_2px_rgba(0,0,0,1)]">
                                {{ $item->published_at->format('d') }}
                                {{ __('month.rod-m-'.$item->published_at->format('m')) }}
                                {{ $item->published_at->format('Y') }}
                            </h3>
                        </div>
                        <div class="absolute bottom-5 left-5 right-5 p-3 rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm border border-gray-100 bg-indigo-700/20">

                            <p class="font-semibold text-white [text-shadow:3px_1px_2px_rgba(0,0,0,1)]">
                                {{ $item->title }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


    <div class="flex flex-col gap-7">
        <div class="flex items-center gap-7">
            <h2 class="text-normal 2xl:text-xl font-bold">Мероприятия</h2>
            <a href="{{ url('events') }}" class="text-[#CCCCCC] group flex text-sm 2xl:text-normal items-center gap-2 hover:text-[#C10F1A] transition duration-300 ease-linear">
                Все мероприятия
                <span>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.33398 3.33398H16.6673M16.6673 3.33398V16.6673M16.6673 3.33398L3.33399 16.6673" stroke="#CCCCCC" class="group-hover:stroke-[#C10F1A] transition duration-300 ease-linear" stroke-width="2"/>
                                    </svg>
                                </span>
            </a>
        </div>
        <div class="flex flex-col gap-2.5">
            @foreach($events as $item )
                <a href="{{ $item->link }}" class="flex w-full flex-col border-b border-[#EEEEEE] py-5">
                    <h3 class="text-[#C10F1A] text-xl font-bold">
                        {{ $item->event_datetime->format('d') }}
                        {{ __('month.rod-m-'.$item->event_datetime->format('m')) }}
                    </h3>
                    <p class="line-clamp-2 2xl:line-clamp-3 font-semibold">
                        {{ $item->title }}
                    </p>
                    <div class="flex items-center gap-2.5 text-[#BBBBBB]">
                        <span>{{ $item->event_datetime->format('H:i') }}</span>
                        <span>Местоположение события</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
