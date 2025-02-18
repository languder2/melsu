<div
    id="tab_department_base"
    @class([
        "department_form_box",
        "bg-purple-700 text-white p-4",
        (!old('_token') || old('side_menu') === 'tab_department_base')?'':'hidden'
    ])
>
    base
</div>
