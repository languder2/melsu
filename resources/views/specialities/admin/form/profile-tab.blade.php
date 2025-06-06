<div class="text-lg bg-red-800 flex-1">
    <input
        id="forms_{{$form->name}}}_check"
        type="radio"
        name="profile_tab"

        @checked(old('profile_tab') === "forms_{$form->name}_tab")
        @checked(!old('_token') && ($form===\App\Enums\EducationForm::Full))

        @class([
            'peer',
            'hidden',
        ])

        value="forms_{{$form->name}}_tab"
        onchange="Tabs.showTab(this,'.profiles-tabs')"

        @if(old('spec_menu') === 'tab_faq')
            checked
        @endif
    >
    <label for="forms_{{$form->name}}}_check"
           class="
                block py-4 px-4 mb-1
                bg-white
                text-right
                cursor-pointer
                select-none

                peer-checked:text-white
                peer-checked:bg-base-red

                hover:text-red-700
                hover:bg-gray-100
            "
    >
        {{$form->getName()}}
    </label>
</div>
