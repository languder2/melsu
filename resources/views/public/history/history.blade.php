@extends("layouts.page")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')

@section('content')
    <div class="grid sm:grid-cols-[90px_auto] lg:grid-cols-[110px_auto]">
        <div class="bg-[#909194] sm:p-4 relative">
            <div class="sticky top-30 lg:top-50 flex flex-col gap-5">
                <div class="hidden sm:flex flex-col">
                    @foreach ($groupedHistories as $groupName => $group)
                        @php
                            $lastItem = $group->sortByDesc('year')->first();
                        @endphp
                        <a href="javascript:scrollToBlock('block-{{ $lastItem->id }}')"
                        class="group-link text-gray-200 lg:text-xl relative transition duration-300 ease-linear font-bold block mb-2 px-3 py-2 rounded-lg hover:text-white"
                        data-group="{{ $groupName }}">
                            {{$groupName}}
                        </a>
                    @endforeach
                </div>
                <div class="flex justify-center">
                    <button id="open-popover-btn" popovertarget="all-years" class="cursor-pointer fixed top-25 left-2 sm:relative sm:top-0 sm:left-0 p-2 text-white bg-gray-400 transition duration-300 ease-linear sm:hover:bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5m4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5m-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5m-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="absolute right-[-50vw] sm:right-[-85vw] md:right-[-75vw] lg:right-[-80vw] 2xl:right-[-85vw] h-[90%]">
                <div class="sticky top-[55%] hidden sm:flex flex-col gap-5">
                    <button onclick="scrollToPrevious()" class="right-20 top-1/2 transform -translate-y-1/2 text-white cursor-pointer bg-[#820000] hover:bg-[#C10F1A] rounded-full p-3 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
                    </svg>
                    </button>
                    
                    <button onclick="scrollToNext()" class="right-4 top-1/2 transform -translate-y-1/2 text-white cursor-pointer bg-[#820000] hover:bg-[#C10F1A] rounded-full p-3 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div>
            @foreach ($histories as $item)
                <div id="block-{{$item->id}}" class="parallax-bg" style="background-image: url('{{ Storage::url($item->image) }}');">
                    <div class="flex flex-col gap-3 relative">
                        <div class="height-date z-5 relative">
                            <div class="relative left-[-10%]">
                                <span class="date-overlay">{{ $item->year }}</span>
                                <span class="under-date" style="background-image: url('{{ Storage::url($item->image) }}');">
                                    {{ $item->year }}
                                </span>
                            </div>
                        </div>
                        <h1 class="text-white text-3xl font-bold drop-shadow-lg" style="text-shadow: 3px 2px 8px rgba(0, 0, 0, 1);">{!! $item->description !!}</h1>
                        <a href="{{ route('public.history.show', $item->id) }}" class="text-white flex border border-[#C10F1A] bg-[#C10F1A] w-fit p-2 hover:opacity-80 transition duration-300 ease-linear z-10">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div popover id="all-years"
        class="modal-image transition-discrete starting:open:opacity-0 fixed open:backdrop-brightness-50 overflow-y-scroll overflow-x-hidden w-[80%] mx-auto max-h-[80%] border-2 border-white shadow-md shadow-white">
        <div class="flex flex-col gap-5 p-5">
            @foreach ($histories as $item)
                <a href="javascript:void(0)" 
                onclick="scrollToYearAndClose({{ $item->id }})"
                class="grid grid-cols-[10%_auto] md:grid-cols-[5%_auto] gap-5 items-center hover:bg-gray-100 p-2 rounded transition-colors">
                    <div class="font-semibold">
                        {{$item->year}}
                    </div>
                    <div>
                        {!! $item->description !!}
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <style>
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: calc(100vh - 150px);
            display: flex;
            align-items: center;
            padding: 0 10%;
            min-width: 80%;
        }

        .group-link.active {
            color: white !important;
        }

        .group-link::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 0;
            background: #C10F1A;
            border-radius: 2px;
            transition: height 0.3s ease;
        }
        .group-link.active::before {
            height: 80%;
        }
        body:has(#all-years[popover]:open) {
            overflow: hidden;
        }
        @media screen and (max-width: 1023px){
            .parallax-bg{
                height: calc(100vh - 90px);
            }
        }
    </style>

    <script src="{{asset('js/new-history.js')}}"></script>
@endsection