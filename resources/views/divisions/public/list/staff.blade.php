<div class="group bg-white p-6 flex flex-col justify-between mb-3 last:mb-0 hover:bg-gray-100">
    <a
            href="{!!url($staff->link)!!}"
            class="grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-4"
    >
        <div class="mx-auto max-h-[250px] sm:max-h-full">
            @if($staff->avatar->name !== 'avatar')
                <img src="{!!$staff->avatar->thumbnail!!}" alt="{!!$staff->avatar->name!!}" class="h-full lg:h-40 w-full object-top object-contain">
            @else
                <div class="flex items-center bg-neutral-150 w-40 h-40 justify-center rounded-md">
                    <svg height="120px" viewBox="0 0 128 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.6455 90.9125C16.8993 96.9333 -8.6546 109.227 6.90945 124.611C14.5124 132.126 22.9801 137.5 33.626 137.5H94.374C105.02 137.5 113.488 132.126 121.091 124.611C136.655 109.227 111.101 96.9333 101.354 90.9125C78.4998 76.7939 49.5002 76.7939 26.6455 90.9125Z" stroke="#C10F1A" stroke-width="4"></path>
                        <path d="M92.1818 31.0882C92.1818 46.8771 79.5644 59.6765 64 59.6765C48.4356 59.6765 35.8182 46.8771 35.8182 31.0882C35.8182 15.2994 48.4356 2.5 64 2.5C79.5644 2.5 92.1818 15.2994 92.1818 31.0882Z" stroke="#C10F1A" stroke-width="4"></path>
                    </svg>
                </div>
            @endif
        </div>
        <div class="flex flex-col justify-between">
            <div class="mb-4 sm:flex-row">
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
                    {!!$staff->full_name!!}
                </h3>
                @if($post)
                    <div class="grid grid-cols-1 lg:grid-cols-[auto_1fr] gap-2 sm:gap-4 mb-0">
                        <span class="text-[var(--secondary-color)] text-md font-bold">Должность:</span>
                        <div class="text-[#4C4C4C] text-md pt-0 lg:ps-3 sm:pt-0 font-semibold sm:font-normal">
                            {!!$post!!}
                        </div>
                    </div>
                @endif
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-[2fr_1fr] lg:grid-cols-2 xl:grid-cols-[2fr_1fr] gap-4">
                @if($staff->address)
                    <div class="mb-0 flex flex-col gap-2">
                        <span class="text-[#4C4C4C]">
                            Адрес:
                        </span>
                        <p class="font-semibold text-[#4C4C4C]">
                            {!! str_replace('!!!','<br>',$staff->address) !!}
                        </p>
                    </div>
                @endif
                @if($staff->phones)
                    <div class="sm:mb-0 flex flex-col gap-2">
                        <span class="text-[#4C4C4C]">
                            Телефон:
                        </span>
                        <p class="font-semibold text-[#4C4C4C]">
                            {!!$staff->phones!!}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </a>
</div>

@if($staff->divisions->count())
    <h3 class="font-semibold text-xl mt-8 mb-6">
        Курируемые структурные подразделения
    </h3>
    <div class="mb-8 bg-white p-4">
        <div class="grid grid-cols-2 sm:grid-cols-[2fr_1fr] gap-4">
            <div class="font-semibold text-sm sm:text-base">
                Подразделение
            </div>
            <div class="font-semibold text-sm sm:text-base">
                Руководитель
            </div>
            @foreach($staff->divisions as $division)
                @if(strtolower($division->code) === 'rectorate')
                    @continue
                @endif
                @component("divisions.public.list.division",['division' => $division,'depth' => 0]) @endcomponent
            @endforeach
        </div>
    </div>
@endif

