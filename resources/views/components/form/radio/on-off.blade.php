<label class="group pt-3 cursor-pointer w-22 select-none">

    <input
        type="hidden"
        name="{{ $name ?? 'is_show' }}"
        value=""
    >

    <input
        type="checkbox"
        name="{{$name ?? 'is_show'}}"
        class="hidden"
        @checked( $value )
    >
    <span class="text-2xl">
        <i
            class="
                fas fa-toggle-on
                hidden
                text-green-700
                group-has-checked:block
            "
        >
            ON
        </i>
        <i
            class="
                fas fa-toggle-off
                block
                text-red-700
                group-has-checked:hidden
            "
        >
            OFF
        </i>
    </span>
</label>
