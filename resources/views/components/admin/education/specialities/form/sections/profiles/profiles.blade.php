<div
    id="tab_profiles"
    @class([
        'speciality-tabs',
        ' mx-auto',
        str_contains($attributes['class'], 'hidden')?'hidden':'',
    ])
>
    <x-admin.education.specialities.form.sections.profiles.tabs>
        @foreach($forms as $code=>$form)
            <x-admin.education.specialities.form.sections.profiles.tab
                :code="$code"
                :form="$form"
                :currentTab="old('profile_tab')??'forms_'.array_key_first($forms).'_tab'"
            />
        @endforeach
    </x-admin.education.specialities.form.sections.profiles.tabs>

    @foreach($forms as $code=>$form)
        <x-admin.education.specialities.form.sections.profiles.profile
            :code="$code"
            :form="$form"
            :currentTab="old('profile_tab')??'forms_'.array_key_first($forms).'_tab'"
            :profile="@$profiles[$code]"
        />
    @endforeach
</div>


