@if($events->isNotEmpty() && $news->isNotEmpty())
    <div class="@container mt-6 relative">
        <div id="NewsIncludeBlock" class="absolute -mt-40"></div>
        <div class="grid mx-2 2xl:mx-auto grid-cols-1 @min-[1100px]:grid-cols-[auto_500px] gap-5 max-w-base-container mb-4">
            <div class="flex flex-col gap-7 @container">
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
                <div class="grid grid-cols-1 @min-xl:grid-cols-2 gap-3">
                    @foreach($news as $item)
                        <div class="shadow-md border @if(!$loop->index) @min-xl:col-span-2 @endif">
                            <a href="{{ $item->link }}" class="block relative aspect-video">

                                <img src="{{ $item->preview->thumbnail }}" class="w-full object-cover box-border aspect-video" alt="">

                                <x-html.glass
                                    absolute
                                    top="2"
                                    left="2"
                                >
                                    {{ $item->published_at->format('d') }}
                                    {{ __('month.rod-m-'.$item->published_at->format('m')) }}
                                    {{ $item->published_at->format('Y') }}
                                </x-html.glass>



                                <div
                                    class="
                                    absolute inset-x-0 bottom-0 drop-shadow-white p-3 font-semibold
                                    text-white
                                    bg-gradient-to-t
                                    from-black
                                    text-shadow-md text-shadow-black
                                "
                                >
                                    {!! $item->title !!}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col gap-7">
                <div class="flex items-center gap-7">
                    <h2 class="text-normal 2xl:text-xl font-bold">Мероприятия</h2>
                    <a href="{{ url('events') }}" class="text-[#CCCCCC] group flex 2xl:text-normal items-center gap-2 hover:text-[#C10F1A] transition duration-300 ease-linear">
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
    </div>
@elseif($news->isNotEmpty())
    <div class="flex items-center gap-7 mt-6 mb-2 justify-between relative">
        <div id="NewsIncludeBlock" class="absolute -mt-40"></div>
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
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-3">
        @foreach($news as $item)
            <div class="shadow-md border @if(!$loop->index) @min-xl:col-span-2 @endif">
                <a href="{{ $item->link }}" class="block relative aspect-video">

                    <img src="{{ $item->preview->thumbnail }}" class="w-full object-cover box-border aspect-video" alt="">

                    <x-html.glass
                        absolute
                        top="2"
                        left="2"
                    >
                        {{ $item->published_at->format('d') }}
                        {{ __('month.rod-m-'.$item->published_at->format('m')) }}
                        {{ $item->published_at->format('Y') }}
                    </x-html.glass>



                    <div
                        class="
                                    absolute inset-x-0 bottom-0 drop-shadow-white p-3 font-semibold
                                    text-white
                                    bg-gradient-to-t
                                    from-black
                                    text-shadow-md text-shadow-black
                                "
                    >
                        {!! $item->title !!}
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@elseif($events->isNotEmpty())
    <div class="flex items-center gap-7 mt-6 justify-between relative">
        <div id="NewsIncludeBlock" class="absolute -mt-40"></div>
        <h2 class="text-normal 2xl:text-xl font-bold">Мероприятия</h2>
        <a href="{{ url('events') }}" class="text-[#CCCCCC] group flex 2xl:text-normal items-center gap-2 hover:text-[#C10F1A] transition duration-300 ease-linear">
            Все мероприятия
            <span>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.33398 3.33398H16.6673M16.6673 3.33398V16.6673M16.6673 3.33398L3.33399 16.6673" stroke="#CCCCCC" class="group-hover:stroke-[#C10F1A] transition duration-300 ease-linear" stroke-width="2"/>
                                    </svg>
                                </span>
        </a>
    </div>
    <div class="grid grid-cols-1 2xl:grid-cols-2 gap-3">
        @foreach($events as $item )
            <a href="{{ $item->link }}" class="flex flex-col gap-3 w-full border-b border-neutral-150 py-5">
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
@endif







