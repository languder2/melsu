@props([
    'hideAddButton' => true
])

<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between shadow sticky top-0 z-50">

    <x-html.submit-link
        link="{{ route('division.staff.cabinet.list', $division) }}"
        :inline="!Route::is('division.staff.cabinet.list')"
        :text="__('common.Staffs')"
    />

    <x-html.submit-link
        link="{{ route('division.staff.cabinet.on-approval', $division) }}"
        :inline="!Route::is('division.staff.cabinet.on-approval')"
        :text="__('common.Staffs on approval')"
    />

    <div class="hidden lg:block flex-1"></div>

</div>
