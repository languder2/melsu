@props([
    'hideAddButton' => true
])
<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between">

    <x-html.submit-link
        link="{{ route('news.cabinet.list') }}"
        :inline="!Route::is('news.cabinet.list')"
        text="Все новости"
    />

    <x-html.submit-link
        link="{{ route('news.cabinet.onApproval') }}"
        :inline="!Route::is('news.cabinet.onApproval')"
        text="Новости требующие утверждения"
    />

    <div class="hidden lg:block flex-1"></div>

    <x-html.submit-link
        link="{{ route('news.cabinet.form') }}"
        text="Добавить новость"
    />
</div>
