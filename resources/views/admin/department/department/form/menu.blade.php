{{view('admin/department/department/form/menu-item',[
    'tabs'      => 'department_form_box',
    'tab'       => 'tab_department_base',
    'text'      => 'Базовые параметры',
    'first'     => true
])}}
{{view('admin/department/department/form/menu-item',[
    'tabs'      => 'department_form_box',
    'tab'       => 'tab_department_staffs',
    'text'      => 'Сотрудники',
])}}
{{view('admin/department/department/form/menu-item',[
    'tabs'      => 'department_form_box',
    'tab'       => 'tab_department_documents',
    'text'      => 'Документы',
])}}
{{view('admin/department/department/form/menu-item',[
    'tabs'      => 'department_form_box',
    'tab'       => 'tab_department_contents',
    'text'      => 'Секции контента',
])}}
