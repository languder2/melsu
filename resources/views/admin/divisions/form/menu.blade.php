@include('admin.divisions.form.menu-item',[
    'tabs'      => 'form_box',
    'tab'       => 'tab_base',
    'text'      => 'Базовые параметры',
    'first'     => true
])

@include('admin.divisions.form.menu-item',[
    'tabs'      => 'form_box',
    'tab'       => 'tab_contacts',
    'text'      => 'Контакты',
])

@include('admin.divisions.form.menu-item',[
    'tabs'      => 'form_box',
    'tab'       => 'tab_staffs',
    'text'      => 'Сотрудники',
])

@include('admin.divisions.form.menu-item',[
    'tabs'      => 'form_box',
    'tab'       => 'tab_documents',
    'text'      => 'Документы',
])

@include('admin.divisions.form.menu-item',[
    'tabs'      => 'form_box',
    'tab'       => 'tab_contents',
    'text'      => 'Секции контента',
])
