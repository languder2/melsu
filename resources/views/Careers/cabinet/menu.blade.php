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

    @if(auth()->user()->isEditor())
        <x-html.submit-link
            link="{{ $instance->careersCabinetChangeApproved('unset') }}"
            :text="Blade::render('<x-lucide-layout-list class=\'w-6\'/>')"
            title="Снять утверждение и публикацию со всех"
        />

        <x-html.submit-link
            link="{{ $instance->careersCabinetChangeApproved() }}"
            :text="Blade::render('<x-lucide-list-checks class=\'w-6\'/>')"
            title="Утвердить и опубликовать все"
        />
    @endif


    <x-html.submit-link
        link="{{ $instance->careers_cabinet_add }}"
        :text="__('common.Add career')"
    />
</div>
