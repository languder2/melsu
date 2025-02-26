<div
    @class([
        'theme1-alt-select',
        'relative',
        $class??null
    ])
>
    <input type="hidden" class="select-value" name="{{$name}}" value="{{$value}}">


    <div
        class="
            group
            px-4 py-3 border rounded-lg outline-0
            flex gap-4
            items-center
            cursor-pointer
            hover:border-stone-700
            transition-all duration-300
            hover:shadow-md hover:shadow-stone-700/20
            open:shadow-md
        "
        onclick="PublicAction.AltSelectShow(this)"
    >
        <span class="flex-1 select-text">
            {{$base}}
        </span>

        <i
            class="
                fas fa-chevron-down font-base
                transition-all duration-300
                group-open:rotate-180
            "
        ></i>

        <ol
            class="
                absolute
                inset-x-0
                top-14
                border-0
                rounded-lg
                overflow-y-scroll
                overflow-x-hidden
                transition-max-h duration-400
                ease-in-out
                max-h-0
                group-open:max-h-60
                group-open:border
            "
        >
            <li
                data-code=""
                class="px-4 py-2 bg-stone-50 hover:bg-gray-100"
                onclick="PublicAction.AltSelectSet(this,this.closest('.theme1-alt-select'))"
            >
                {{$base}}
            </li>
            @foreach($list as $code=>$value)
                <li
                    data-code="{{$code}}"
                    class="px-4 py-2 bg-stone-50 hover:bg-gray-100"
                    onclick="PublicAction.AltSelectSet(this,this.closest('.theme1-alt-select'))"
                >
                    {{$value}}
                </li>
            @endforeach
        </ol>
    </div>

</div>
