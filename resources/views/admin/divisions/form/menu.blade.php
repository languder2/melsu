@include('admin.divisions.form.menu-item',[
    'tabs'      => 'division_form_box',
    'tab'       => 'tab_division_base',
    'text'      => 'Базовые параметры',
    'first'     => true
])

@include('admin.divisions.form.menu-item',[
    'tabs'      => 'division_form_box',
    'tab'       => 'tab_division_staffs',
    'text'      => 'Сотрудники',
])

@include('admin.divisions.form.menu-item',[
    'tabs'      => 'division_form_box',
    'tab'       => 'tab_division_documents',
    'text'      => 'Документы',
])

@include('admin.divisions.form.menu-item',[
    'tabs'      => 'division_form_box',
    'tab'       => 'tab_division_contents',
    'text'      => 'Секции контента',
])
