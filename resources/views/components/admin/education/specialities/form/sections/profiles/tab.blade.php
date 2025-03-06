<div class="text-lg bg-red-800 flex-1">
    <input
        id="forms_{{$code}}}_check"
        type="radio"
        name="profile_tab"

        @checked($currentTab === "forms_{$code}_tab")

        @class([
            'peer',
            'hidden',
        ])
        value="forms_{{$code}}_tab"
        onchange="Tabs.showTab(this,'.profiles-tabs')"
        @if(old('spec_menu') === 'tab_faq')
            checked
        @endif
    >
    <label for="forms_{{$code}}}_check"
           class="
                block py-4 px-4 mb-1
                bg-white
                text-right
                cursor-pointer
                select-none

                peer-checked:text-white
                peer-checked:bg-baseRed

                hover:text-red-700
                hover:bg-gray-100
            "
    >
        {{$form}}
    </label>
</div>
