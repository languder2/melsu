<div class="bg-white p-6 sm:min-h-[257px] flex flex-col justify-between">
    <div class="grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-5 min-h-[209px]">
        <div class="mx-auto">
            <img src="{{$staff->avatar->thumbnail}}" alt="{{$staff->avatar->name}}" class="max-h-60">
        </div>
        <div class="flex flex-col justify-evenly">
            <div class="mb-7 lg:mb-0 sm:flex-row">
                <div class="mb-2">
                    <div class="text-red-700 text-md font-bold">Должность:</div>
                    <div>
                        @foreach($staff->AffiliationPosts() as $post)
                            <span class="lg:text-nowrap">
                                {{ $post }}@if(!$loop->last && $loop->count>1),@endif
                            </span>
                        @endforeach
                    </div>
                </div>

                @if($staff->title)
                    <div class="flex flex-col mb-2">
                        <div class="text-red-700 text-md font-bold">
                            Ученая степень, звание:
                        </div>
                        <div class="flex items-center">
                            {{$staff->title}}
                        </div>
                    </div>
                @endif
            </div>

            @if($staff->reception_time)
                <div class="flex flex-col mb-2">
                    <div class="text-red-700 text-md font-bold">
                        Прием по личным вопросам:
                    </div>
                    <div class="flex items-center">
                        {{$staff->reception_time}}
                    </div>
                </div>
            @endif

            <div class="flex justify-between flex-col sm:flex-row mb-7 lg:mb-0">
                @if($staff->address)
                    <div class="w-[100%] mb-7 sm:mb-0">
                            <span class="text-red-700 text-md font-bold">
                                Адрес:
                            </span>
                        <p>
                            {!! str_replace('!!!',' ',$staff->address) !!}
                        </p>
                    </div>
                @endif

                @if($staff->phone)
                    <div class="w-[100%]">
                            <span class="text-[#4C4C4C] text-lg">
                                Телефон:
                            </span>
                        <p class="font-semibold text-lg text-[#4C4C4C]">
                            {{$staff->phone}}
                        </p>
                    </div>
                @endif

                @if($staff->emails)
                    <div class="w-[100%]">
                            <span class="text-[#4C4C4C] text-lg">
                                Email:
                            </span>
                        <p class="font-semibold text-lg text-[#4C4C4C]">
                            {{$staff->emails}}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="bg-white p-6 flex flex-col justify-between mt-5">
    <div class="grid grid-cols-1 lg:grid-cols-[25%_minmax(70%,_1fr)] mb-7 lg:mb-0 gap-y-5 gap-x-1">
        @if($staff->birthday_formated)
            <span class="text-[var(--secondary-color)] text-md font-bold">
            Дата рождения:
        </span>
            <div class="flex items-center ">
            <span class="text-[#4C4C4C] text-md pt-3 sm:ps-3 sm:pt-0">
                {{$staff->birthday_formated}}
            </span>
            </div>
        @endif

        @if($staff->birthplace)
            <span class="text-[var(--secondary-color)] text-md font-bold">Место рождения:</span>
            <div class="flex items-center">
            <span class="text-[#4C4C4C] text-md pt-3 sm:ps-3 sm:pt-0">
                {{$staff->birthplace}}
            </span>
            </div>
        @endif

        @if($staff->residence)
            <span class="text-[var(--secondary-color)] text-md font-bold">Место жительства:</span>
            <div class="flex items-center">
            <span class="text-[#4C4C4C] text-md pt-3 sm:ps-3 sm:pt-0">
                {{$staff->residence}}
            </span>
            </div>
        @endif

        @if($staff->education)
            <span class="text-[var(--secondary-color)] text-md font-bold">Образование:</span>
            <div class="flex items-center">
                <div class="text-[#4C4C4C] text-md pt-3 sm:ps-3 sm:pt-0 ul-correct">
                    {!! $staff->education !!}
                </div>
            </div>
        @endif
        @if($staff->education)
            <div class="text-[var(--secondary-color)] text-md font-bold">Переподготовка:</div>
            <div class="flex items-center">
                <div class="text-[#4C4C4C] text-md pt-3 sm:ps-3 sm:pt-0 ul-correct">
                    {!! $staff->retraining !!}
                </div>
            </div>
        @endif

        @if($staff->awards)
            <span class="text-[var(--secondary-color)] text-md font-bold">Награды, поощрение:</span>
            <div class="flex items-center">
            <span class="text-[#4C4C4C] text-md pt-3 sm:ps-3 sm:pt-0 flex flex-col gap-2">
                {!! $staff->awards !!}
            </span>
            </div>
        @endif

        @if($staff->affiliation)
            <span class="text-[var(--secondary-color)] text-md font-bold">Партийная принадлежность:</span>
            <div class="flex items-center">
                <span class="text-[#4C4C4C] text-md pt-3 sm:ps-3 sm:pt-0">
                    {{$staff->affiliation}}
                </span>
            </div>
        @endif
    </div>
</div>

{{--@if($staff->awards)--}}
{{--    <h2 class="font-bold text-3xl my-6">Трудовая деятельность</h2>--}}
{{--    <div class="bg-white p-3 flex flex-col gap-3">--}}
{{--        {!! $staff->awards !!}--}}
{{--    </div>--}}
{{--@endif--}}

@if($staff->jobs->isNotEmpty())
    <div class="work-experience">
        <h2 class="font-bold text-3xl my-6">Трудовая деятельность</h2>
        <div class="work-experience-box grid grid-cols-1 lg:grid-cols-[200px_minmax(70%,_1fr)] gap-1">
            @foreach($staff->sortedJobs as $job)
                <div class="bg-white p-3 flex items-center justify-center font-semibold">
                    @if($job->employment_year)
                        c {{$job->employment_year}}
                    @endif

                    @if($job->dismissal_year)
                        по {{ $job->dismissal_year }}
                    @else
                        по наст. вр.
                    @endif
                </div>
                <div class="bg-white p-3 flex flex-col gap-3">
                    @if($job->company)
                        <div class="font-semibold">
                            {!! $job->company !!}
                        </div>
                    @endif

                    @if($job->post)
                        @foreach(explode('<br>', $job->post) as $post)
                            <div>
                                {!! $post !!}
                            </div>
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif

