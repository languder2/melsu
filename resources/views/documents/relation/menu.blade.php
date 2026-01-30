@props([
    'hideAddButton' => true
])

<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between shadow">

    <x-html.submit-link
        link="{{ route('documents.relation.list', [$instance->getTable(), $instance->id]) }}"
        :inline="!Route::is('documents.relation.list')"
        :text="__('common.Documents')"
    />

    <x-html.submit-link
        link="{{ route('documents-category.relation.on-approval', [$instance->getTable(), $instance->id]) }}"
        :inline="!Route::is('documents-category.relation.on-approval')"
        :text="__('common.Documents on approval')"
    />

    <div class="hidden lg:block flex-1"></div>

    <x-html.submit-link
        link="{{ route('documents-category.relation.form', [$instance->getTable(), $instance->id]) }}"
        :text="__('common.Add documents category')"
    />
</div>
