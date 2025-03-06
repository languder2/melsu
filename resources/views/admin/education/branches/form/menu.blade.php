@include('components.html.admin.form-menu-item',[
    'tabs'      => 'form_box',
    'tab'       => 'tab_base',
    'text'      => 'Основная информация',
    'first'     => true,
])

@include('components.html.admin.form-menu-item',[
    'tabs'      => 'form_box',
    'tab'       => 'tab_staffs',
    'text'      => 'Сотрудники',
    'disabled'  => !isset($current->department),
])

@include('components.html.admin.form-menu-item',[
    'tabs'      => 'form_box',
    'tab'       => 'tab_documents',
    'text'      => 'Документы',
    'disabled'  => !isset($current->department),
])

@include('components.html.admin.form-menu-item',[
    'tabs'      => 'form_box',
    'tab'       => 'tab_contents',
    'text'      => 'Секции контента',
    'disabled'  => !isset($current->department),
])
