<div class="grid md:grid-cols-2 2xl:grid-cols-[60%_auto] gap-5 max-w-base-container mx-auto mb-4">
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
                <div class="@if($loop->first) sm:col-span-2 @endif shadow shadow-md shadow-gray-400 border">
                    <a href="{{ $item->link }}" class="h-100 block relative ">

                        <img src="{{ $item->preview->thumbnail }}" class="w-full h-100 object-cover box-border" alt="">
                        <div
                            class="meta-category liquid-glass border-0 text-white text-sm absolute top-2 left-2 px-5 py-3 font-[500]" style="background: rgba(0, 0, 0, 0.25);">
                            <div class="liquid-glass--bend"></div>
                            <div class="liquid-glass--face"></div>
                            <div class="liquid-glass--edge"></div>
                            <div class="liquid-glass__menus"></div>
                            <div class="liquid-glass__content h-full">
                                <div class="flex lg:flex-col items-center lg:items-start justify-between gap-5 h-full">
                                    <span class="relative z-10 font-bold [text-shadow:3px_1px_2px_rgba(0,0,0,1)]">
                                        {{ $item->published_at->format('d') }}
                                        {{ __('month.rod-m-'.$item->published_at->format('m')) }}
                                        {{ $item->published_at->format('Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="meta-category liquid-glass border-0 text-white absolute bottom-2 inset-x-2 px-5 py-3 font-[500]" style="background: rgba(0, 0, 0, 0.25);">
                            <div class="liquid-glass--bend"></div>
                            <div class="liquid-glass--face"></div>
                            <div class="liquid-glass--edge"></div>
                            <div class="liquid-glass__menus"></div>
                            <div class="liquid-glass__content h-full">
                                <div class="flex lg:flex-col items-center lg:items-start justify-between gap-5 h-full">
                                    <span class="relative z-10 font-bold [text-shadow:3px_1px_2px_rgba(0,0,0,1)]">
                                        {!! $item->title !!}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            @foreach($news as $item)
                <div class="@if($loop->first) sm:col-span-2 @endif shadow shadow-md shadow-gray-400 border">
                    <a href="{{ $item->link }}" class="h-100 block relative ">

                        <img src="{{ $item->preview->thumbnail }}" class="w-full h-100 object-contain bg-gray-200 box-border" alt="">
                        <div
                            class="meta-category liquid-glass border-0 text-white text-sm absolute top-2 left-2 px-5 py-3 font-[500]" style="background: rgba(0, 0, 0, 0.25);">
                            <div class="liquid-glass--bend"></div>
                            <div class="liquid-glass--face"></div>
                            <div class="liquid-glass--edge"></div>
                            <div class="liquid-glass__menus"></div>
                            <div class="liquid-glass__content h-full">
                                <div class="flex lg:flex-col items-center lg:items-start justify-between gap-5 h-full">
                                    <span class="relative z-10 font-bold [text-shadow:3px_1px_2px_rgba(0,0,0,1)]">
                                        {{ $item->published_at->format('d') }}
                                        {{ __('month.rod-m-'.$item->published_at->format('m')) }}
                                        {{ $item->published_at->format('Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="meta-category liquid-glass border-0 text-white absolute bottom-2 inset-x-2 px-5 py-3 font-[500]" style="background: rgba(0, 0, 0, 0.25);">
                            <div class="liquid-glass--bend"></div>
                            <div class="liquid-glass--face"></div>
                            <div class="liquid-glass--edge"></div>
                            <div class="liquid-glass__menus"></div>
                            <div class="liquid-glass__content h-full">
                                <div class="flex lg:flex-col items-center lg:items-start justify-between gap-5 h-full">
                                    <span class="relative z-10 font-bold [text-shadow:3px_1px_2px_rgba(0,0,0,1)]">
                                        {!! $item->title !!}
                                    </span>
                                </div>
                            </div>
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
