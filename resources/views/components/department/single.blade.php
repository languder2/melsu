@if($department->chief_card)
    <div class="bg-white p-6 sm:min-h-40 flex flex-col justify-between mb-3">
        <div class="mb-7 sm:mb-0">
            <a href="{{$department->chief_card->link}}" class="font-bold text-2xl mb-5 block">
                {{$department->chief_card->full_name}}
            </a>
            <div class="flex flex-col sm:flex-row mb-3">
            <span class="text-[#4C4C4C] text-lg">
                Должность:
            </span>
                <span class="text-[var(--secondary-color)] text-lg pt-3 sm:pl-3 sm:pt-0">
                {{$department->chief_post}}
            </span>
            </div>
        </div>

        <div class="flex justify-between flex-col sm:flex-row mb-7 sm:mb-0">
            <div class="w-[100%] mb-7 sm:mb-0">
                <span class="text-[#4C4C4C] text-lg">
                    Адрес:
                </span>
                <p class="font-semibold text-lg text-[#4C4C4C]">
                    корпус 9, каб. 224
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
    </div>
@endif

@if($department->sections->count())
    @foreach($department->sections as $section)
        <div class="about-otdel">
            @if($section->show_title === 'show')
                <h2 class="font-bold text-3xl my-6">
                    {{$section->name}}
                </h2>
            @endif
            <div class="bg-white p-6 mb-5">
                {!! $section->text !!}
            </div>
        </div>
    @endforeach
@endif

@if($department->staffs->count())
    <div class="employees-about">
        <h2 class="font-bold text-3xl my-6 text-end">Сотрудники</h2>
        <div class="employees-box grid grid-cols-1 lg:grid-cols-[25%_minmax(70%,_1fr)] gap-1">
            @foreach($department->staffs as $staff)
                <div class="bg-white p-2.5">
                    <span>{{$staff->card->full_name}}</span>
                </div>
                <div class="bg-white p-2.5 flex items-center">
                    <span class="ps-3 lg:ps-0">
                        {{$staff->post}}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
@endif
