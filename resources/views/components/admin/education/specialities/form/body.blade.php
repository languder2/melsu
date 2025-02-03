<x-head.tinymce-config />
<div
    class="
        bg-white
        py-4 px-4
    "
>
    <x-admin.education.specialities.form.header />

    <x-form.errors />


    <x-admin.education.specialities.form.sections.speciality
        :class="(old('spec_menu') === 'tab_speciality' || empty(old('spec_menu')))?'block':'hidden'"
        :current="$current"
        :add2faculty="$add2faculty"
        :faculties="$faculties"
        :departments="$departments"
        :levels="$levels"
        :forms="$forms"
    />

</div>
