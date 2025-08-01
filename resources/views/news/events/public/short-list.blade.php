<section class="container custom p-2.5 xl:p-0">
    <div class="grid grid-cols-1 lg:grid-cols-[17%_auto] gap-5">
        <div class="bg-[#C10F1A]">
            
        </div>
        <div>
            <h3 class="font-semibold text-2xl px-5 pt-10 pb-7">
                Мероприятия
            </h3>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 bg-white gap-5 lg:gap-0">
    @foreach($list as $items)
        <div class="flex flex-col lg:grid lg:grid-cols-[17%_auto]">
            <div class="bg-[#C10F1A] p-5 lg:py-5 lg:p-0 flex items-center lg:items-baseline gap-5 h-fit lg:h-auto">
                    <h4 class="text-white text-2xl sm:text-5xl lg:text-8xl font-bold lg:px-12 sticky">
                        {{ $items->day }}
                    </h4>
                <div class="flex flex-col lg:hidden">
                    <h3 class="text-white text-xl font-semibold">{{ __('month.rod-m-'.$items->month) }}</h3>
                    <h5 class="text-[#C0C0C0] text-base font-semibold">{{ __('month.day-'.$items->dayOfWeek) }}</h5>
                </div>
            </div>

        <div class="grid grid-cols-1 lg:grid-cols-[17%_auto] border lg:border-b lg:border-0 border-[#C0C0C0] p-5 lg:py-5 lg:p-0 gap-x-5 h-full lg:h-auto">
            <div class="hidden lg:flex flex-col ps-5">
                <h4 class="font-extrabold text-4xl">{{ __('month.rod-m-'.$items->month) }}</h4>
                <h5 class="text-[#C0C0C0] uppercase text-3xl font-semibold">{{ __('month.day-'.$items->dayOfWeek) }}</h5>
            </div>
            <div id="block{{$items->day}}-{{$items->month}}" class="grid grid-cols-1 lg:grid-cols-2 gap-x-5 gap-y-6">
            @foreach($items->events as $item)
                @if($loop->iteration <= 4)
                    <a href="{{route('public:event:show',$item->id)}}" class="flex flex-col gap-4 group cursor-pointer @if($loop->even) lg:pe-5 @endif">
                        <h3 class="text-xl sm:text-3xl font-extrabold group-hover:text-[#C10F1A] transition duration-300 ease-linear flex justify-between items-center">
                            @if($item->FormatedEventDatetime('H:i'))
                                {{ $item->FormatedEventDatetime('H:i') }}
                            @else 
                                <div class="h-[16px] w-[16px] sm:w-[36px] sm:h-[36px]">
                                    <svg width="100%" height="100%" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.5 10.5C7.5 16.299 10.701 18 16.5 18C10.701 18 7.5 22.701 7.5 28.5V33M28.5 28.5V33" stroke="#252525" stroke-width="3" stroke-linecap="round"/>
                                        <path d="M28.5 33H6" stroke="#252525" stroke-width="3" stroke-linecap="round"/>
                                        <path d="M30.1667 3C30.1667 2.17157 29.4951 1.5 28.6667 1.5C27.8382 1.5 27.1667 2.17157 27.1667 3H30.1667ZM24.8789 14.0035C24.3285 14.6226 24.3843 15.5707 25.0035 16.1211C25.6226 16.6715 26.5707 16.6157 27.1211 15.9965L24.8789 14.0035ZM30 4.5C30.8284 4.5 31.5 3.82843 31.5 3C31.5 2.17157 30.8284 1.5 30 1.5V4.5ZM12 1.5C11.1716 1.5 10.5 2.17157 10.5 3C10.5 3.82843 11.1716 4.5 12 4.5L12 1.5ZM28.6667 3H27.1667V6H28.6667H30.1667V3H28.6667ZM28.6667 6H27.1667C27.1667 7.95723 27.1586 9.26716 26.8743 10.4593C26.6075 11.5778 26.0761 12.6566 24.8789 14.0035L26 15L27.1211 15.9965C28.5906 14.3434 29.3925 12.8319 29.7924 11.1553C30.1747 9.55233 30.1667 7.86226 30.1667 6H28.6667ZM30 3V1.5H12L12 3L12 4.5H30V3Z" fill="#252525"/>
                                        <path d="M4.5 1.5L34.5 28.5" stroke="#252525" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="h-[16px] w-[16px] flex lg:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5"/>
                                    <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z"/>
                                </svg>
                            </div>
                        </h3>
                        <p class="font-medium">{!! $item->title !!}</p>
                    </a>
                @else
                    <a href="{{route('public:event:show',$item->id)}}" class="flex flex-col gap-4 group cursor-pointer @if($loop->even) lg:pe-5 @endif hidden">
                        <h3 class="text-xl sm:text-3xl font-extrabold group-hover:text-[#C10F1A] transition duration-300 ease-linear flex justify-between items-center">
                            @if($item->FormatedEventDatetime('H:i'))
                                {{ $item->FormatedEventDatetime('H:i') }}
                            @else 
                                <div class="h-[16px] w-[16px] sm:w-[36px] sm:h-[36px]">
                                    <svg width="100%" height="100%" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.5 10.5C7.5 16.299 10.701 18 16.5 18C10.701 18 7.5 22.701 7.5 28.5V33M28.5 28.5V33" stroke="#252525" stroke-width="3" stroke-linecap="round"/>
                                        <path d="M28.5 33H6" stroke="#252525" stroke-width="3" stroke-linecap="round"/>
                                        <path d="M30.1667 3C30.1667 2.17157 29.4951 1.5 28.6667 1.5C27.8382 1.5 27.1667 2.17157 27.1667 3H30.1667ZM24.8789 14.0035C24.3285 14.6226 24.3843 15.5707 25.0035 16.1211C25.6226 16.6715 26.5707 16.6157 27.1211 15.9965L24.8789 14.0035ZM30 4.5C30.8284 4.5 31.5 3.82843 31.5 3C31.5 2.17157 30.8284 1.5 30 1.5V4.5ZM12 1.5C11.1716 1.5 10.5 2.17157 10.5 3C10.5 3.82843 11.1716 4.5 12 4.5L12 1.5ZM28.6667 3H27.1667V6H28.6667H30.1667V3H28.6667ZM28.6667 6H27.1667C27.1667 7.95723 27.1586 9.26716 26.8743 10.4593C26.6075 11.5778 26.0761 12.6566 24.8789 14.0035L26 15L27.1211 15.9965C28.5906 14.3434 29.3925 12.8319 29.7924 11.1553C30.1747 9.55233 30.1667 7.86226 30.1667 6H28.6667ZM30 3V1.5H12L12 3L12 4.5H30V3Z" fill="#252525"/>
                                        <path d="M4.5 1.5L34.5 28.5" stroke="#252525" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="h-[16px] w-[16px] flex lg:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5"/>
                                    <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z"/>
                                </svg>
                            </div>
                        </h3>
                        <p class="font-medium">{!! $item->title !!}</p>
                    </a>
                @endif
            @endforeach
            </div>
            @if($items->events->count() > 4)
                    <button onclick="handleMoreButtonClick(event)" class="sm:col-span-2 mt-2 pt-3 border-t border-[#C0C0C0] btn-more flex justify-center font-semibold text-lg cursor-pointer underline underline-offset-3 transition duration-300 ease-linear hover:text-[#C10F1A]">
                        Еще
                    </button>
            @endif
        </div>
    </div>
    @endforeach
    <div class="bg-white group transition duration-300 ease-linear hover:bg-[#820000] w-[17%]">
        <a href="{{ route('public:events:calendar') }}" class="flex p-5 justify-between items-center transition duration-300 ease-linear group-hover:text-white">
            Больше
            <span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.33333 1H15M15 1V12.6667M15 1L1 15" class="stroke-[#252525] transition duration-300 ease-linear group-hover:stroke-white"  stroke-width="2"/>
                </svg>
            </span>
        </a>
    </div>
    <div>

    </div>
    <div>

    </div>
</div>
</section>
<script>
    function handleMoreButtonClick(event) {
    event.preventDefault();

    console.log('Клик сработал!');
    const button = event.target;
    const parent = button.parentElement;
    button.classList.toggle('active');
    const allLinks = parent.querySelectorAll('a');
    if(button.classList.contains('active')){
        allLinks.forEach(element => {
        element.classList.remove('hidden');
    });
        button.textContent = 'Свернуть';
    }
    else{
        allLinks.forEach((element, index) => {
            if (index >= 4) {
                element.classList.add('hidden');
            }
        });
        button.textContent = 'Еще';
    }
}
</script>
