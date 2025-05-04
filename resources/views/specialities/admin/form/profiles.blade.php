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
        @each('specialities.admin.form.profile-tab',EducationForm::cases(),'form')
    </div>


    @use('App\Models\Education\Profile')
    @foreach(EducationForm::cases() as $form)
        @component('specialities.admin.form.profile',[
            'form'      => $form,
            'profile'   => $current->profiles->where('form',$form->value)->first() ?? new Profile()
        ])@endcomponent
    @endforeach
</div>
