@component('admin.components.form-menu-item',[
    'tabs'      => 'form_box',
    'tab'       => 'tab_base',
    'text'      => 'Основа',
    'active'    => true

]) @endcomponent

@component('admin.components.form-menu-item',[
    'tabs'      => 'form_box',
    'tab'       => 'tab_contacts',
    'text'      => 'Контакты',
    'disabled'  => !$current->exists

]) @endcomponent

<x-html.admin.form-menu-item
    tabs='form_box'
    tab='tab_contacts'
    text='Контакты'
    @disabled(true)

/>

<x-html.admin.form-menu-item
    tabs='form_box'
    tab='tab_staffs'
    text='Сотрудники'
    @disabled(true)

/>

<x-html.admin.form-menu-item
    tabs='form_box'
    tab='tab_documents'
    text='Документы'
    @disabled(true)

/>

<x-html.admin.form-menu-item
    tabs='form_box'
    tab='tab_contents'
    text='Секции контента'
    @disabled(true)

/>

<x-html.admin.form-menu-item
    tabs='form_box'
    tab='tab_news'
    text='Новости'
    @disabled(true)

/>
