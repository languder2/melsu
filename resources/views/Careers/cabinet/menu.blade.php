@props([
    'hideAddButton' => true
])

<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between shadow">

    <x-html.submit-link
        link="{{ $instance->careers_cabinet_list }}"
        :inline=" $instance->hasCareersCabinetList() "
        :text="__('common.Careers')"
    />

    <x-html.submit-link
        link="{{ $instance->careers_cabinet_on_approval_list }}"
        :inline=" $instance->hasCareersCabinetOnApproval() "
        :text="__('common.Careers on approval')"
    />

    <div class="hidden lg:block flex-1"></div>

    <x-html.submit-link
        link="{{ $instance->careers_cabinet_add }}"
        :text="__('common.Add career')"
    />
</div>
