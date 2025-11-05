@props([
    'hideAddButton' => true
])
<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between">

    <x-html.submit-link
        link="{{ route('pages.cabinet.list') }}"
        :inline="!Route::is('pages.cabinet.list')"
        text="Все страницы"
    />

    <x-html.submit-link
        link="{{ route('pages.cabinet.on-approval') }}"
        :inline="!Route::is('pages.cabinet.on-approval')"
        text="Не опубликованные или требующие утверждения"
    />

    <div class="hidden lg:block flex-1"></div>

    <x-html.submit-link
        link="{{ route('events.cabinet.form') }}"
        text="Добавить страницу"
    />
</div>
