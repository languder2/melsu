<div class="text-lg">
    <input
        id="menu_speciality"
        type="radio"
        name="spec_menu"
        class="peer hidden"
        value="tab_speciality"
        onchange="Tabs.showTab(this,'.speciality-tabs')"
        @if(empty(old('spec_menu')) || old('spec_menu') === 'tab_speciality')
            checked
        @endif
    >
    <label for="menu_speciality"
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
        Специальность
    </label>
</div>

<div class="text-lg">
    <input
        id="menu_profiles"
        type="radio"
        name="spec_menu"
        class="peer hidden"
        value="tab_profiles"
        onchange="Tabs.showTab(this,'.speciality-tabs')"
        @if(old('spec_menu') === 'tab_profiles')
            checked
        @endif
    >
    <label for="menu_profiles"
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
        Профили
    </label>
</div>

<div class="text-lg">
    <input
        id="menu_documents"
        type="radio"
        name="spec_menu"
        class="peer hidden"
        value="tab_documents"
        onchange="Tabs.showTab(this,'.speciality-tabs')"
        @if(old('spec_menu') === 'tab_documents')
            checked
        @endif
    >
    <label for="menu_documents"
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
        Документы
    </label>
</div>

<div class="text-lg">
    <input
        id="menu_links"
        type="radio"
        name="spec_menu"
        class="peer hidden"
        value="tab_links"
        onchange="Tabs.showTab(this,'.speciality-tabs')"
        @if(old('spec_menu') === 'tab_links')
            checked
        @endif
    >
    <label for="menu_links"
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
        Ссылки
    </label>
</div>

<div class="text-lg">
    <input
        id="menu_faq"
        type="radio"
        name="spec_menu"
        class="peer hidden"
        value="tab_faq"
        onchange="Tabs.showTab(this,'.speciality-tabs')"
        @if(old('spec_menu') === 'tab_faq')
            checked
        @endif
    >
    <label for="menu_faq"
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
        FAQ
    </label>
</div>
