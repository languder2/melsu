@props([
    'has_menu' => false
])
@php
    $class = $has_menu
    ? 'grid grid-cols-[auto_auto_1fr_repeat(2,auto)] gap-3 mb-3 font-semibold'
    : 'grid grid-cols-subgrid col-span-full gap-3'
@endphp

@if($division->exists)
    <div
        class="{{ $class }}"
    >
        @if(auth()->user()->isAdmin())
            <div class="flex items-center justify-center p-3 rounded-sm shadow bg-white">
                    <x-html.button-delete-with-modal
                        question="Удалить подразделение"
                        :text=" $division->name "
                        :action=" $division->delete "
                        icoClass='hover:text-amber-700'
                    />
            </div>
        @endif
        <div class=" flex items-center justify-center p-3 rounded-sm shadow bg-white {{ auth()->user()->isAdmin() ? '' : 'col-span-2' }}">
            {!! $division->id !!}
        </div>

        <div class="flex gap-3 items-center bg-white p-3 rounded-sm shadow">
            @if(!$has_menu)
                @for($i=1; $i <= $division->level; $i++)
                    <span class="px-1"></span>
                @endfor

                @if($division->level)
                    <x-lucide-corner-down-right class="w-4" />
                @endif
            @endif

            {!! $division->name !!}
        </div>
        <div class="flex gap-5 items-center justify-center flex-wrap w-16 2xl:w-auto bg-white p-3 rounded-sm shadow ">
            <a href="{{ $division->link }}" target="_blank" class="flex-end hover:text-green-700" title="Перейти на страницу">
                <x-lucide-square-arrow-out-up-right class="w-6"/>
            </a>

            <a href="{{ $division->cabinet_form }}" class="hover:text-amber-500" title="Редактировать">
                <x-lucide-square-pen class="w-6" />
            </a>
        </div>

        <div class="flex gap-5 items-center justify-center flex-wrap w-56 2xl:w-auto bg-white p-3 rounded-sm shadow ">

            <a href="{{ $division->documents_cabinet_list }}" class="flex-end hover:text-green-700" title="{{ __('common.Documents') }}">
                <x-lucide-files class="w-6"/>
            </a>

            <a href="{{ $division->contacts_cabinet_list }}" class="flex-end hover:text-green-700" title="{{ __('common.Contacts') }}">
                <x-lucide-phone class="w-6"/>
            </a>

            @php $status = $division->goals()->count() && $division->goals()->where('is_approved',false)->count() > 0 @endphp
            <a href="{{ $division->goals_cabinet_list }}" class="flex-end hover:text-green-700 relative" title="{{ __('common.Goals') . ($status ? '. На модерации' : '')  }}">
                <x-lucide-goal class="w-6 {{ $status ? 'text-red-700' : null }}"/>

                @if($status)
                    <x-lucide-triangle-alert class="w-4 absolute -bottom-0.5 -right-1 text-red-700 bg-white" />
                @endif
            </a>

            @php $status = $division->partners()->count() && $division->partners()->where('is_approved',false)->count() > 0 @endphp
            <a href="{{ $division->partnersCabinetList() }}" class="flex-end hover:text-green-700 relative" title="{{ __('common.Partners') . ($status ? '. На модерации' : '') }}">
                <x-lucide-handshake class="w-6 {{ $status ? 'text-red-700' : null }}"/>
                @if($status)
                    <x-lucide-triangle-alert class="w-4 absolute -bottom-0.5 -right-1 text-red-700 bg-white" />
                @endif
            </a>

            @php $status = $division->careers()->count() && $division->careers()->where('is_approved',false)->count() > 0 @endphp
            <a href="{{ $division->careers_cabinet_list }}" class="flex-end hover:text-green-700 relative" title="{{ __('common.Careers') . ($status ? '. На модерации' : '') }}">
                <x-lucide-id-card-lanyard class="w-6 {{ $status ? 'text-red-700' : null }}"/>
                @if($status)
                    <x-lucide-triangle-alert class="w-4 absolute -bottom-0.5 -right-1 text-red-700 bg-white" />
                @endif
            </a>

            @php $status = $division->graduations()->count() && $division->graduations()->where('is_approved',false)->count() > 0 @endphp
            <a href="{{ $division->graduations_cabinet_list }}" class="flex-end hover:text-green-700 relative" title="{{ __('common.Graduations') . ($status ? '. На модерации' : '') }}">
                <x-lucide-graduation-cap class="w-6 {{ $status ? 'text-red-700' : null }}"/>
                @if($status)
                    <x-lucide-triangle-alert class="w-4 absolute -bottom-0.5 -right-1 text-red-700 bg-white" />
                @endif
            </a>

            @php $status = $division->science()->count() && $division->science()->where('is_approved',false)->count() > 0 @endphp
            <a href="{{ $division->science_cabinet_list }}" class="flex-end hover:text-green-700 relative" title="{{ __('common.Science') . ($status ? '. На модерации' : '') }}">
                <x-lucide-microscope class="w-6 {{ $status ? 'text-red-700' : null }}"/>
                @if($status)
                    <x-lucide-triangle-alert class="w-4 absolute -bottom-0.5 -right-1 text-red-700 bg-white" />
                @endif
            </a>

            <a href="{{ $division->history_form }}" class="flex-end hover:text-green-700" title="{{ __('common.History') }}">
                <x-lucide-file-clock class="w-6"/>
            </a>

            <a href="{{ $division->achievements_form }}" class="flex-end hover:text-green-700 relative" title="{{ __('common.Achievements') }}">
                <x-lucide-file-badge class="w-6"/>
            </a>

            <a href="{{ $division->gallery_form }}" class="flex-end hover:text-green-700" title="{{ __('common.gallery') }}">
                <x-lucide-images class="w-6"/>
            </a>
        </div>
    </div>
@endif
