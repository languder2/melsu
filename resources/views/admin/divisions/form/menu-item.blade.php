<div class="text-lg">
    <input
        id="menu_{{$tab}}"
        type="radio"
        name="side_menu"
        class="peer hidden"
        value="{{$tab}}"
        onchange="Actions.showTab(this.value,'.{{$tabs}}')"


        @checked(isset($first))
        @checked(old('_token') && old('side_menu') === $tab)

    >
    <label for="menu_{{$tab}}"
           class="
                block py-4 px-4 mb-1
                bg-white
                text-right
                cursor-pointer
                select-none

                peer-checked:text-white
                peer-checked:bg-baseRed

                hover:text-red-700
            "
    >
        {{@$text}}
    </label>
</div>
