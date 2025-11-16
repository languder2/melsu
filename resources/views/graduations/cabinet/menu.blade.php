@props([
    'hideAddButton' => true
])

<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between shadow">

    <x-html.submit-link
        link="{{ $instance->graduations_cabinet_list }}"
        :inline=" $instance->hasGraduationsCabinetList() "
        :text="__('common.Graduations')"
    />

    <x-html.submit-link
        link="{{ $instance->graduations_cabinet_on_approval_list }}"
        :inline=" $instance->hasGraduationsCabinetOnApproval() "
        :text="__('common.Graduations on approval')"
    />

    <div class="hidden lg:block flex-1"></div>

    <x-html.submit-link
        link="{{ $instance->graduations_cabinet_add }}"
        :text="__('common.Add graduation')"
    />
</div>
