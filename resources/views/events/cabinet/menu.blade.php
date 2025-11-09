@props([
    'hideAddButton' => true
])
<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between">

    <x-html.submit-link
        link="{{ route('events.cabinet.list') }}"
        :inline="!Route::is('events.cabinet.list')"
        text="Все мероприятия"
    />

    <x-html.submit-link
        link="{{ route('events.cabinet.on-approval') }}"
        :inline="!Route::is('events.cabinet.on-approval')"
        text="Мероприятия требующие утверждения"
    />

    <div class="hidden lg:block flex-1"></div>

    <x-html.submit-link
        link="{{ route('events.cabinet.form') }}"
        text="Добавить мероприятие"
    />
</div>
