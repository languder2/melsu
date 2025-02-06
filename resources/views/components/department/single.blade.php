<div class="bg-white p-6 sm:min-h-[257px] flex flex-col justify-between">
    <div class="grid grid-cols-1 lg:grid-cols-[25%_minmax(70%,_1fr)] gap-5 min-h-[209px]">
        <div class="mx-auto">
            <img src="{{asset("images/photo/600x600_{$staff->photo}.jpg")}}" alt="" class="">
        </div>
        <div class="flex flex-col justify-evenly">
            <div class="mb-7 lg:mb-0 sm:flex-row">
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

            @if($staff->address)
                <div class="flex justify-between flex-col sm:flex-row mb-7 lg:mb-0">
                    <div class="w-[100%] mb-7 sm:mb-0">
                    <span class="text-[#4C4C4C] text-lg">
                        Адрес:
                    </span>
                        <p class="font-semibold text-lg text-[#4C4C4C]">
                            {{$staff->address}}
                        </p>
                    </div>
                    <div class="w-[100%]">
                    <span class="text-[#4C4C4C] text-lg">
                        Телефон:
                    </span>
                        <p class="font-semibold text-lg text-[#4C4C4C]">
                            +7 (990) XXX-XX-XX
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
