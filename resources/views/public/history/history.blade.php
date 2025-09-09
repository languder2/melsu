@extends("layouts.page")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')

@section('content')

    <section class="h--timeline js-h--timeline relative">
    <div id="prevtBtn" class="absolute left-10 top-[35%] z-10 bg-[#C10F1A]/[.6] rounded-full cursor-pointer p-2 transition duration-300 ease-linear hover:bg-[#C10F1A]">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" class="bi bi-chevron-compact-left fill-white transition duration-300 ease-linear" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M9.224 1.553a.5.5 0 0 1 .223.67L6.56 8l2.888 5.776a.5.5 0 1 1-.894.448l-3-6a.5.5 0 0 1 0-.448l3-6a.5.5 0 0 1 .67-.223"/>
        </svg>
    </div>
    <div id="nextBtn" class="absolute right-10 top-[35%] z-10 bg-[#C10F1A]/[.6] rounded-full cursor-pointer p-2 transition duration-300 ease-linear hover:bg-[#C10F1A]">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-chevron-compact-right fill-white" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
        </svg>
    </div>
    <div class="h--timeline-events">
        <ol>
            @foreach ($histories as $history)
                <li class="h--timeline-event text-component bg-white history-slide overflow-hidden @if($loop->first) h--timeline-event--selected @endif">
                    <div class="h--timeline-event-content">
                        <div class="height-date z-5">
                            <div class="relative">
                                <span class="date-overlay">{{ $history->year }}</span>
                                <span class="under-date" style="background-image: url('{{ Storage::url($history->image) }}');">
                                    {{ $history->year }}
                                </span>
                            </div>
                        </div>
                        <div class="h--timeline-event-description z-5">
                            <div class="font-semibold text-md md:text-lg xl:text-xl line-clamp-6 lg:line-clamp-none">
                                {!! $history->description !!}
                            </в>
                            @if($history->content)
                            <div class="btn-more-box flex items-center">
                                <button class="btn-more flex items-center cursor-pointer" style="font-size: 16px;" popovertarget="modal-{{$history->id}}">
                                    Подробнее
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="w-full full-img-history">
                        <img src="{{ Storage::url($history->image) }}" class="object-cover h-full w-full" alt="">
                    </div>
                </li>
            @endforeach
        </ol>
    </div> <!-- .h--timeline-events -->
    <div class="h--timeline-container">
        <div class="h--timeline-dates">
            <div class="h--timeline-line">
                <ol>
                    @foreach ($histories as $history)
                        <li>
                            <a data-date="01/01/{{$history->year}}" class="h--timeline-date cursor-pointer @if($loop->first) h--timeline-date--selected @endif">
                                {{$history->year}}
                            </a>
                        </li>
                    @endforeach
                </ol>

                <span class="h--timeline-filling-line" aria-hidden="true"></span>
            </div>
        </div>

        <nav class="h--timeline-navigation-container">
            <ul>
                <li><a href="#0" class="text-replace h--timeline-navigation h--timeline-navigation--prev flex items-center">
                        <svg width="31" height="20" viewBox="0 0 31 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M31 10.2571H0.999999M0.999999 10.2571L13.7869 1M0.999999 10.2571L13.7869 19" stroke="" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </li>
                <li><a href="#0" class="text-replace h--timeline-navigation h--timeline-navigation--next flex items-center">
                        <svg width="31" height="20" viewBox="0 0 31 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 10.2571H30M30 10.2571L17.2131 1M30 10.2571L17.2131 19" stroke="" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</section>
    @foreach ($histories as $history)
        @if($history->content)
    <div popover="manual" id="modal-{{$history->id}}"
        class="modal-image transition-discrete starting:open:opacity-0 fixed bg-gray-700 p-8 open:backdrop-brightness-50 w-[95%] sm:w-[97%] md:w-[98%] 2xl:w-[80%] max-h-[80%] h-fit shadow-md shadow-gray-800 z-40">
        <div class="wrapp-modal-video relative text-white">
            <span class="close-modal absolute border border-[#820000] right-[-20px] top-[-20px] bg-[#820000] rounded-full text-white py-[2px] px-[8px] cursor-pointer transition duration-300 ease-linear hover:bg-white hover:text-[#820000] z-20">X</span>
            {!! $history->content !!}
        </div>
    </div>
        @endif
    @endforeach
<script src="{{asset('js/history-slider.js')}}"></script>
<script>
    document.querySelector('.my-6').classList.add('hidden');
    const modalContent = document.querySelectorAll('.modal-image');
    const closeBtn = document.querySelectorAll('.close-modal');

    closeBtn.forEach((item,index) => {
        item.addEventListener('click', () =>  {
            modalContent[index].hidePopover();
        });
    })

    document.addEventListener('click', (event) => {

        modalContent.forEach((item, index) =>{
            if (item.matches(':popover-open')) {
                const clickInsideModal = event.composedPath().includes(item);
                if (!clickInsideModal) {
                    item.hidePopover();
                }
            }
        })

    });
</script>
@endsection
