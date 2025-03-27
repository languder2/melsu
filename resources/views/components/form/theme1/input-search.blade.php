<div
    @class([
        'theme1-input-search',
        $class??null
    ])
>
    <div
        class="
            group
            border rounded-lg outline-0
            flex gap-4
            items-center
            cursor-pointer
            transition-all duration-300
            open:shadow-md
        "
    >

        <input
            name="search"
            value=""
            class="
                px-4 py-3
                outline-0
                border-none
                inline-block
                flex-1
            "
            onkeydown="PublicAction.KeyDownTimer(this)"
            onchange="PublicAction.FormSend(this.closest('form'),document.getElementById('{{$block}}'))"
        >
        <i class="fas fa-search pr-4 "></i>

    </div>

</div>
