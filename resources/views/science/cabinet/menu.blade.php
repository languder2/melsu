@props([
    'hideAddButton' => true
])

<div class="mb-3 p-3 bg-white flex flex-col lg:flex-row gap-3 justify-between shadow">

    <x-html.submit-link
        link="{{ $instance->science_cabinet_list }}"
        :inline=" $instance->hasScienceCabinetList() "
        :text="__('common.Science')"
    />

    <x-html.submit-link
        link="{{ $instance->science_cabinet_on_approval_list }}"
        :inline=" $instance->hasScienceCabinetOnApproval() "
        :text="__('common.Science on approval')"
    />

    <div class="hidden lg:block flex-1"></div>

    <x-html.submit-link
        link="{{ $instance->science_cabinet_add }}"
        :text="__('common.Add science')"
    />
</div>

