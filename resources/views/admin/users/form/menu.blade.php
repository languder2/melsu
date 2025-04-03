<x-html.admin.form-menu-item
    tabs='form_box'
    tab='tab_base'
    text='Данные пользователя'
    :active="true"
/>

<x-html.admin.form-menu-item
    tabs='form_box'
    tab='tab_staff'
    text='Данные сотрудника'
    @disabled(true)
/>
