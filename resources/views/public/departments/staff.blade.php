<div class="group bg-white p-6 flex flex-col justify-between mb-3 last:mb-0 hover:bg-gray-100">
    <a
        href="{{url($staff->link)}}"
        class="grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-4"
    >
        <div class="mx-auto">
            <img
                src="{{$staff->avatar->thumbnail}}"
                alt="{{$staff->full_name}}"
                class="h-40"
            >
        </div>
        <div class="flex flex-col justify-between">
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
                @if($post)
                    <div class="grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-4 mb-7 lg:mb-0">
                        <span class="text-[var(--secondary-color)] text-md font-bold">Должность:</span>
                        <div class="text-[#4C4C4C] text-md pt-3 sm:ps-3 sm:pt-0">
                            {{$post}}
                        </div>
                    </div>
                @endif
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-[2fr_1fr] gap-4">
                @if($staff->address)
                    <div class="mb-7 sm:mb-0">
                        <span class="text-[#4C4C4C]">
                            Адрес:
                        </span>
                        <p class="font-semibold text-[#4C4C4C]">
                            {!! str_replace('!!!','<br>',$staff->address) !!}
                        </p>
                    </div>
                @endif
                @if($staff->phones)
                    <div >
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

@if($staff->departments->count())
    <h3 class="font-semibold text-xl mt-8 mb-6">
        Курируемые структурные подразделения
    </h3>
    <div class="mb-8 bg-white p-4">
        <div
            class="
                grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-4
            "
        >
            <div class="font-semibold">
                Подразделение
            </div>
            <div class="font-semibold">
                Руководитель
            </div>
            @foreach($staff->departments as $department)
                @if(strtolower($department->code) === 'rectorate') @continue @endif
                @include("public.departments.department",['department' => $department,'depth' => 0])
            @endforeach
        </div>
    </div>
@endif

