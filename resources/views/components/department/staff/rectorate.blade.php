<div class="group bg-white p-6 sm:min-h-[257px] flex flex-col justify-between mb-3 last:mb-0 hover:bg-gray-100">
    <a
        href="{{url($staff->link)}}"
        class="grid grid-cols-1 lg:grid-cols-[auto_minmax(70%,_1fr)] gap-5 min-h-[209px]"
    >
            <div class="mx-auto">
                @if($staff->avatar->name !== 'avatar')
                    <img src="{{$staff->avatar->thumbnail}}" alt="{{$staff->avatar->name}}" class="max-h-60">
                @endif
            </div>
        <div class="flex flex-col justify-evenly">
            <div class="mb-7 lg:mb-0 sm:flex-row">
                <h3
                    class="
                        font-semibold
                        mb-3
                        text-xl
                        block
                        text-baseRed
                        group-hover:text-red-700
                        group-active:text-gray-700
                        group-hover:underline
                    "
                >
                    {{$staff->full_name}}
                </h3>
                @if($staff->post)
                    <div class="grid grid-cols-1 lg:grid-cols-[25%_minmax(70%,_1fr)] mb-7 lg:mb-0">
                        <span class="text-[var(--secondary-color)] text-md font-bold">Должность:</span>
                        <div class="flex items-center">
                        <span class="text-[#4C4C4C] text-md pt-3 sm:ps-3 sm:pt-0">
                            {{$staff->post}}
                        </span>
                        </div>
                    </div>
                @endif

                @if($staff->title)
                    <div class="grid grid-cols-1 lg:grid-cols-[25%_minmax(70%,_1fr)]">
                        <span class="text-[var(--secondary-color)] text-md font-bold">Ученая степень, звание:</span>
                        <div class="flex items-center">
                        <span class="text-[#4C4C4C] text-md pt-3 sm:ps-3 sm:pt-0">
                            {{$staff->title}}
                        </span>
                        </div>
                    </div>
                @endif
            </div>

            @if($staff->reception_time)
                <div class="mb-7 lg:mb-0 sm:flex-row">
                    <div class="grid grid-cols-1 lg:grid-cols-[25%_minmax(70%,_1fr)]">
                        <span class="text-[var(--secondary-color)] text-md font-bold">Прием по личным вопросам:</span>
                        <div class="flex items-center">
                        <span class="text-[#4C4C4C] text-md pt-3 sm:ps-3 sm:pt-0">
                            {{$staff->reception_time}}
                        </span>
                        </div>
                    </div>
                </div>
            @endif

                <div class="flex justify-between flex-col sm:flex-row mb-7 lg:mb-0">
                    @if($staff->address)
                        <div class="w-[100%] mb-7 sm:mb-0">
                            <span class="text-[#4C4C4C]">
                                Адрес:
                            </span>
                                <p class="font-semibold text-[#4C4C4C]">
                                    {!! str_replace('!!!','<br>',$staff->address) !!}
                                </p>
                        </div>
                    @endif

                    @if($staff->phones)
                        <div class="w-[100%]">
                            <span class="text-[#4C4C4C]">
                                Телефон:
                            </span>
                            <p class="font-semibold text-[#4C4C4C]">
                                {{$staff->phones}}
                            </p>
                        </div>
                    @endif
                </div>
        </div>
    </a>
</div>
