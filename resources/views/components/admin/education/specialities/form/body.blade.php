<x-head.tinymce-config/>

<div
    class="
        bg-white
        py-4 px-4
    "
>
    <x-admin.education.specialities.form.header/>

    <x-form.errors :box="true"/>

    <x-admin.education.specialities.form.sections.speciality
        :class="(old('spec_menu') === 'tab_speciality' || empty(old('spec_menu')))?'':'hidden'"
        :current="$current"
        :add2faculty="$add2faculty"
        :faculties="$faculties"
        :departments="$departments"
        :levels="$levels"
        :faculties2="$faculties"
        :departments2="$departments"
    />

    <x-admin.education.speciality.form.sections.profiles.profiles
        :class="(old('spec_menu') === 'tab_profiles')?'':'hidden'"
        :profiles="@$current->profiles??null"
    />
</div>

