<form
    method="post"
    data-group-search=".education-profile"
    data-no-search=".no-search"
    class="grid grid-cols-1 lg:grid-cols-[1fr_20%_20%] gap-[12px]  lg:gap-3 mb-3 lg:mb-0"
>
    <div class="box-btns-card grid grid-cols-1 lg:grid-cols-[1fr_1fr_1fr] gap-3 text-center lg:mb-8">

        <label class="btn-filter-card uppercase py-3.5 px-5">
            <input
                type="radio"
                name="level"
                value=""
                class="hidden specialities_filter"
                @if(!isset($current->level)) checked @endif

                data-filter-type="check"
            >
            Все
        </label>

        @foreach($levels as $code=>$level)
            <label class="btn-filter-card uppercase py-3.5 px-5">
                <input
                    type="radio"
                    name="level"
                    value="{{$code}}"
                    class="hidden specialities_filter"

                    data-filter-type="check"

                    @if(isset($current->level) && $current->level === $code) checked @endif
                >
                {{$level}}
            </label>
        @endforeach
    </div>

    <div class="lg:mb-8">
        <input
            type="text"
            name="search"
            class="w-full p-3 bg-white outline-0 focus:border-b-2 min-h-[50px] specialities_filter"
            data-group=".education-profile"
            value=""
            placeholder="Поиск"
            data-filter-type="search"

        >
    </div>

    <div class="box-show-filter">
        <a class="btn-show-filter bg-[#252422] flex items-center justify-center py-[15px] px-[20px] text-white text-center cursor-pointer max-h-[50px]
                                hover:bg-[var(--primary-color)]">Фильтры</a>
    </div>

    <div class="filters-select-box grid grid-cols-1 gap-[12px]  lg:gap-3 lg:mb-8 hidden">
        <div class="select-wrapper relative max-h-[50px]">
            <input
                type="text"
                name="form"
                value="full-time"
                class="input-hidden hidden specialities_filter"

                data-filter-type="check"
            >

            <input class="chosen-value relative top-0 left-0 w-full min-h-[50px] max-h-[50px] text-lg py-3 px-[18px] bg-white
                             transition duration-300 ease-in-out placeholder:text-[black] focus:border-b-[2px] outline-0 z-20"
                   type="text" value="Очная" data-placeholder="Форма обучения" placeholder="Форма обучения">
            <ul
                class="
                    value-list
                    transition
                    duration-300
                    ease-in-out
                    absolute top-0 left-0 w-full max-h-0 cursor-pointer list-none mt-[48px] shadow-[2px_24px_17px_-13px_rgba(66, 68, 90, 1)] overflow-hidden
                    z-20
                    peer-focus:max-h-80
                    peer-focus:overflow-y-auto
                "
            >

                @foreach($forms as $code=>$value)
                    <li
                        data-id="{{$code}}"
                        class="
                            drop-li min-h-[4rem] opacity-100 relative p-[1rem] bg-white text-lg
                            flex items-center cursor-pointer transition duration-300 ease-in-out
                            max-h-0 hover:bg-[#820000] hover:text-white
                            [&.closed]:max-h-0 [&.closed]:overflow-hidden [&.closed]:p-0
                            [&.closed]:opacity-0 [&.closed]:min-h-[0px]
                        "
                    >
                        {{$value}}
                    </li>
                @endforeach

            </ul>
        </div>

        <div class="select-wrapper relative max-h-[50px]">
            <input
                type="text"
                name="type"
                value="budget"
                class="input-hidden hidden specialities_filter"

                data-filter-type="check"
            >

            <input
                class="
                    chosen-value
                    relative top-0 left-0 w-full min-h-[50px] max-h-[50px] text-lg py-3 px-[18px] bg-white
                    transition duration-300 ease-in-out placeholder:text-[black]
                    outline-0 z-10
                    border-b
                    border-white
                    focus:border-gray-200
                    peer
                "
                type="text"
                value="Бюджет"
                data-placeholder="Тип обучения"
                placeholder="Тип обучения"
            >
            <ul
                class="
                    value-list transition duration-300 ease-in-out
                    absolute top-0 left-0
                    w-full max-h-0
                    cursor-pointer list-none
                    mt-[50px]
                    shadow-[2px_24px_17px_-13px_rgba(66, 68, 90, 1)]
                    overflow-hidden
                    z-20
                    peer-focus:max-h-80
                    peer-focus:overflow-y-auto
                "
            >

                @foreach($types as $code=>$value)
                    <li
                        data-id="{{$code}}"
                        class="
                            drop-li min-h-[4rem] opacity-100 relative p-[1rem] bg-white text-lg
                            flex items-center cursor-pointer transition duration-300 ease-in-out
                            max-h-0 hover:bg-[#820000] hover:text-white
                            [&.closed]:max-h-0 [&.closed]:overflow-hidden [&.closed]:p-0
                            [&.closed]:opacity-0 [&.closed]:min-h-[0px]
                        "
                    >
                        {{$value}}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</form>
