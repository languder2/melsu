@props([
    'hideAddButton' => true
])

<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between shadow">

    <x-html.submit-link
        link="{{ route('users.cabinet.list') }}"
        :inline="!Route::is('users.cabinet.list')"
        :text="__('common.Users')"
    />

{{--    <x-html.submit-link--}}
{{--        link="{{ $instance->goals_cabinet_on_approval_list }}"--}}
{{--        :inline="!Route::is($instance->GoalsCabinetOnApprovalListRoute)"--}}
{{--        :text="__('common.Goals on approval')"--}}
{{--    />--}}

    <div class="hidden lg:block flex-1"></div>

    <x-html.submit-link
        link="{{ route('users.cabinet.form') }}"
        :text="__('common.Add user')"
    />
</div>
