<div
    id="tab_department_staffs"
    @class([
        "department_form_box",
        "bg-green-700 text-white p-4",
        (old('side_menu') === 'tab_department_staffs')?'':'hidden'
    ])
>
    staffs

    <x-admin.department.form.select-staff
        :i="1"
        keyID="id"
        field="fio"
        :list="$staffs??[]"
        placeholder="Выбрать сотрудника"
    />

</div>

@dump($staffs??"-")
