<div
    @class([
        'text-lg bg-stone-50 group',
        ($disabled ?? null)?'disabled':''
    ])
>
    <input
        id="menu_{{$tab}}"
        type="radio"
        name="side_menu"
        class="peer hidden"
        value="{{$tab}}"
        onchange="Actions.showTab(this.value,'.{{$tabs}}')"

        @checked(isset($active) || (old('_token') && old('side_menu') === $tab))

    >
    <label for="menu_{{$tab}}"
           class="
                block py-4 px-4 mb-1
                text-right
                select-none
                cursor-pointer
                group-[.disabled]:pointer-events-none
                group-[.disabled]:bg-gray-300
                group-[.disabled]:text-gray-600
                group-has-checked:bg-base-red
                group-has-checked:text-white
                hover:text-red-700
                group-has-checked:hover:text-white
            "
    >
        {{@$text}}
    </label>
</div>
