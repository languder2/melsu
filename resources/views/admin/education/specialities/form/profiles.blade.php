<div
    id="tab_profile"
    @class([
        "form_box",
        (old('side_menu') === 'tab_profile')?'':'hidden'
    ])
>
    @use('App\Enums\EducationForm')

    <div
         class="flex gap-2"
    >
        @each('admin.education.specialities.form.profile-tab',EducationForm::cases(),'form')
    </div>

    @foreach(EducationForm::cases() as $form)
        @component('admin.education.specialities.form.profile',[
            'form'      => $form,
            'profile'   => $current->profiles->where('form_code',$form->value)->first()
        ])@endcomponent
    @endforeach
</div>
