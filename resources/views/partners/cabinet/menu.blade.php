@props([
    'hideAddButton' => true
])

<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between shadow">

    <x-html.submit-link
        link="{{ $instance->partnersCabinetList() }}"
        :inline="!Route::is('partners.cabinet.list')"
        :text="__('common.Partners')"
    />

    <div class="hidden lg:block flex-1"></div>

    <x-html.submit-link
        link="{{ $instance->partnerCategoryAdd() }}"
        :text="__('common.Add partner category')"
    />
</div>
