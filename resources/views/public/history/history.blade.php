@extends("layouts.page")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')

@section('content')

    <section class="h--timeline js-h--timeline relative">
        <div class="md:hidden absolute z-10 right-5 top-5">
            <button class="dropdown-btn text-[#820000] hover:text-[#C10F1A] cursor-pointer transition duration-300 ease-linear">
                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                    <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                    <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                </svg>
            </button>
            <div class="absolute w-full h-full">
                <div class="dropdown-date flex flex-col flex-wrap gap-3 bg-white min-w-[130px] max-w-[130px]  z-50 relative p-5 h-max max-h-[200px] overflow-scroll hidden border border-[#C10F1A] left-[-102px] rounded">
                    @foreach ($histories as $history)
                        <a data-date="01/01/{{$history->year}}" class="h--timeline-date cursor-pointer @if($loop->first) h--timeline-date--selected @endif">
                            {{$history->year}}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex w-full absolute top-[60%]">
            <div id="prevtBtn" class="md:hidden absolute right-[20px] transform rotate-[90deg] z-10 bg-[#C10F1A]/[.6] rounded-full cursor-pointer p-2 transition duration-300 ease-linear hover:bg-[#C10F1A]">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" class="bi bi-chevron-compact-up fill-white transition duration-300 ease-linear" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M7.776 5.553a.5.5 0 0 1 .448 0l6 3a.5.5 0 1 1-.448.894L8 6.56 2.224 9.447a.5.5 0 1 1-.448-.894l6-3z"/>
            </svg>
        </div>
        <div id="nextBtn" class="md:hidden absolute right-[20px] top-[86px] transform rotate-[270deg] z-10 bg-[#C10F1A]/[.6] rounded-full cursor-pointer p-2 transition duration-300 ease-linear hover:bg-[#C10F1A]">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" class="bi bi-chevron-compact-down fill-white transition duration-300 ease-linear" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z"/>
            </svg>
        </div>
        </div>
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
            <div class="absolute right-2.5 bottom-0">
                <button class="dropdown-btn relative top-[3px] rounded-full text-[#820000] hover:text-[#C10F1A] cursor-pointer transition duration-300 ease-linear">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
                        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                    </svg>
                </button>
                <div class="absolute w-full h-full">
                    <div class="dropdown-date flex flex-col flex-wrap gap-3 bg-white min-w-[130px] max-w-[130px] z-50 relative p-5 h-max max-h-[200px] overflow-scroll hidden">
                        @foreach ($histories as $history)
                            <a data-date="01/01/{{$history->year}}" class="h--timeline-date cursor-pointer @if($loop->first) h--timeline-date--selected @endif">
                                {{$history->year}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <nav class="h--timeline-navigation-container">
                <ul>
                    <li><a href="#0" class="text-replace h--timeline-navigation h--timeline-navigation--prev flex items-center">
                            <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 7L7 1L1 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li><a href="#0" class="text-replace h--timeline-navigation h--timeline-navigation--next flex items-center">
                            <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L7 7L13 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
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
                                <div class="font-semibold text-md md:text-lg xl:text-xl line-clamp-6 lg:line-clamp-none flex flex-col gap-3">
                                    {!! $history->description !!}
                                </div>
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
        </div>

</section>
    @foreach ($histories as $history)
        @if($history->content)
    <div popover="manual" id="modal-{{$history->id}}"
        class="modal-image transition-discrete starting:open:opacity-0 fixed bg-gray-700 p-8 open:backdrop-brightness-50 w-[95%] sm:w-[97%] md:w-[98%] max-w-[90%] max-h-[80%] lg:w-fit min-w-[40%] h-fit shadow-md shadow-gray-800 z-40 mx-auto">
        <div class="wrapp-modal-video relative text-white">
            <span class="close-modal absolute border border-[#820000] right-[-20px] top-[-20px] bg-[#820000] rounded-full text-white py-[2px] px-[8px] cursor-pointer transition duration-300 ease-linear hover:bg-white hover:text-[#820000] z-20">X</span>
            <div class="flex flex-col gap-6">
                {!! $history->content !!}
            </div>
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
<style>
    .flex.gap-4.mb-6{
        background-color: white !important;
    }
</style>
@endsection
