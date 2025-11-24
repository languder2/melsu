@props([
    'hideAddButton' => true
])

<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between shadow">

    <div class="hidden lg:block flex-1"></div>

    <x-html.submit-link
        link="{{ \App\Models\Division\Division::cabinetAddForm() }}"
        :text="__('common.add division')"
    />

</div>
