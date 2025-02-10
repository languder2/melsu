<div class="departments-box flex flex-col justify-between bg-white p-6 mb-3">
    <div class="mb-7 sm:mb-0 ">

        <a
            class="
                font-bold text-2xl
                block mb-5
                name
                hover:text-red-700
            "
            href="{{$department->link}}"
        >
            {{$department->name}}
        </a>

        @if($department->chief_card)
            <div class="flex flex-col sm:flex-row mb-3">
            <span class="text-[#4C4C4C] text-lg">
                {{$department->chief_post}}:
            </span>
                <a
                    href="{{$department->chief_card?->link}}"
                    class="
                    text-red-700 text-lg pt-3 sm:pl-3 sm:pt-0 sku
                    font-semibold
                    hover:underline
                "
                >
                    {{$department->chief_card?->full_name}}
                </a>
            </div>
        @endif
    </div>
    <div class="flex justify-between flex-col sm:flex-row mb-7 sm:mb-0">
        <div class="w-[100%] mb-7 sm:mb-0">
            <span class="text-[#4C4C4C] text-lg">
                Адрес:
            </span>
            <p class="font-semibold text-lg text-[#4C4C4C]">
                корпус 1, ауд. 209
            </p>
        </div>
        <div class="w-[100%]">
            <span class="text-[#4C4C4C] text-lg">
                Телефон:
            </span>
            <p class="font-semibold text-lg text-[#4C4C4C]">
                +7 (990) 142-78-65
            </p>
        </div>
    </div>
    <div class="btn-more-box">
        <a
            href="{{$department->link}}"
            class="btn-more hover:text-red-900 flex-1 text-right"
        >
            Страница ...
        </a>
        <a
            href="{{$department->link}}"
            class="flex-none"
        >
            <i class="bi bi-arrow-right-circle-fill"></i>
        </a>

    </div>
</div>
