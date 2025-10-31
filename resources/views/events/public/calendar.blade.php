@extends("layouts.page")

@section('content')
<section class="container">
    <div class="bg-white p-5 border border-[#EEEEEE] mb-5 overflow-x-auto">
        <div class="flex gap-2.5">
            <div class="px-5 py-2.5 border border-[#C0C0C0] font-bold text-[#C0C0C0] transition duration-300 ease-linear has-[:checked]:text-[#820000] has-[:checked]:border-[#820000]">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="categories[]" value="all" 
                        class="uppercase font-bold radio-custom all-categories-radio"
                        @if(empty($selectedCategories) || (count($selectedCategories) === 1 && in_array('all', $selectedCategories))) checked @endif>
                    <span class="ml-2">Все</span>
                </label>
            </div>
        
            @foreach($categories as $category)
                <div class="p-2.5 border border-[#C0C0C0] font-bold text-[#C0C0C0] transition duration-300 ease-linear has-[:checked]:text-[#820000] has-[:checked]:border-[#820000] hover:text-[#820000] hover:border-[#820000]">
                    <label class="flex items-center cursor-pointer w-max">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                            class="appearance-none uppercase font-bold radio-custom category-checkbox"
                            @if(in_array($category->id, $selectedCategories)) checked @endif
                            @if(in_array('all', $selectedCategories) && empty($selectedCategories)) checked @endif>
                        <span>{{ $category->name }}</span>
                    </label>
                </div>
            @endforeach
        </div>
</div>
    <div class="grid lg:grid-cols-[2fr_1fr] gap-5">
        <div class="events-calendar-container bg-white border border-[#EEEEEE] p-5">
            <div class="calendar-header mb-10 my-5">
                <div class="month-navigation flex items-center justify-center gap-5">
                    <a href="{{ route('public:events:calendar', [
                    'month' => $calendar->prev->month,
                    'year' => $calendar->prev->year,
                    'categories' => request('categories', [])
                    ]) }}"
                    class="text-2xl px-2 py-1 transition duration-300 ease-linear bg-transparent border border-transparent hover:bg-[#C10F1A] hover:border-[#C10F1A] group">
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 1L1.70711 6.29289C1.37377 6.62623 1.20711 6.79289 1.20711 7C1.20711 7.20711 1.37377 7.37377 1.70711 7.70711L7 13" class="stroke-[#141B34] group-hover:stroke-white transition duration-300 ease-linear" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <div class="flex items-center gap-2">
                        <h2 class="uppercase text-xl w-fit font-bold">{{ $calendar->month }}</h2>
                        <h3 class="uppercase text-xl w-fit font-bold text-[#C0C0C0]">{{ $calendar->year }}</h3>
                    </div>
                    <a href="{{ route('public:events:calendar', [
                    'month' => $calendar->next->month,
                    'year' => $calendar->next->year,
                    'categories' => request('categories', [])
                    ]) }}" class="text-2xl px-2 py-1 transition duration-300 ease-linear bg-transparent border border-transparent hover:bg-[#C10F1A] hover:border-[#C10F1A] group"> 
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 13L6.29289 7.70711C6.62623 7.37377 6.79289 7.20711 6.79289 7C6.79289 6.79289 6.62623 6.62623 6.29289 6.29289L1 1" class="stroke-[#141B34] group-hover:stroke-white transition duration-300 ease-linear" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="grid grid-cols-7 mb-2.5">
                    @for ($i = 1; $i <= 7; $i++)
                        <div class="text-center">
                            <h2 class="text-[#C0C0C0] uppercase text-xl font-bold">{{ __('month.day-'.$i) }}</h2>
                        </div>
                    @endfor
                </div>
                
                @foreach($calendar->weeks as $week)
                    <div class="grid grid-cols-7">
                        @foreach($week as $day)
                            <div data-date="{{ $day->date_key }}" class="calendar-day border border-[#252525] h-[70px] lg:h-[100px] 2xl:h-[140px] p-2.5 flex flex-col justify-between transition duration-300 ease-linear cursor-pointer hover:shadow-[0px_0px_10px_0px_#00000040]
                                {{ !$day ? 'empty' : '' }}
                                {{ $day?->is_today ? 'today' : '' }}
                                {{ $day?->is_weekend ? 'weekend border-[#252525]' : '' }}
                                {{ $day?->is_adjacent_month ? 'adjacent-month border-[#C0C0C0]' : '' }}
                                {{ $day?->month_type === 'prev' ? 'prev-month text-[#C0C0C0]' : '' }}
                                {{ $day?->month_type === 'next' ? 'next-month text-[#C0C0C0]' : '' }}">
                                
                                @if($day)
                                    <div class="lg:text-xl xl:text-2xl font-bold lg:p-2.5">{{ $day->day }}</div>

                                    <div class="flex gap-1">
                                        @if(count($day->events))
                                                @foreach($day->events as $event)
                                                    <div style="background-color: {{ config('colors.categories.' . $event->category_id, '#CCCCCC') }}"
                                                        class="w-[10px] h-[10px] xl:w-[16px] xl:h-[16px] rounded-[4px]" 
                                                        title="{{ $event->category_id }}"
                                                    >
                                                    </div>
                                                @endforeach
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <div class="bg-white border border-[#EEEEEE]">
        <h2 class="text-3xl font-semibold p-5">События</h2>
        <div id="day-events-container">
            <p class="p-5">Выберите день для просмотра событий</p>
        </div>
    </div>
    </div>
</section>
@endsection

<script src="{{asset('js/calendar.js')}}"></script>