@props([
    'hideAddButton' => true
])

<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between shadow sticky top-0 z-50">

    <x-html.submit-link
        link="{{ route('division.posts.cabinet.list', $division) }}"
        :inline="!Route::is('division.posts.cabinet.list')"
        :text="__('common.Approval staffs posts')"
        :counter=" $division->allPublicStaffCount() "
    />

    <x-html.submit-link
        link="{{ route('division.posts.cabinet.on-approval', $division) }}"
        :inline="!Route::is('division.posts.cabinet.on-approval')"
        :text="__('common.Staffs posts on approval')"
        :counter=" $division->allOnApprovalStaffCount() "
    />

    <x-html.submit-link
        link="{{ route('division.posts.cabinet.removed', $division) }}"
        :inline="!Route::is('division.posts.cabinet.removed')"
        :text="__('common.Removed staffs posts')"
        :counter=" $division->allTrashedStaffCount() "
    />

    <div class="hidden lg:block flex-1"></div>
</div>
