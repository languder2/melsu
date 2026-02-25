@props([
    'hideAddButton' => true
])

<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between shadow sticky top-0 z-50">

    <x-html.submit-link
        link="{{ route('documents.cabinet.list') }}"
        :inline="!Route::is('documents.cabinet.list')"
        :text="__('common.Documents')"
    />

    <x-html.submit-link
        link="{{ route('documents.cabinet.on-approval') }}"
        :inline="!Route::is('documents.cabinet.on-approval')"
        :text="__('common.Documents on approval')"
    />

    <div class="hidden lg:block flex-1"></div>

    <x-html.submit-link
        link="{{ route('documents.cabinet.category.form') }}"
        :text="__('common.Add documents category')"
    />
</div>
