@props([
    'has_menu'      => false,
    'division'      => new \App\Models\Division\Division(),
])
@php
    $class = $has_menu
    ? 'grid grid-cols-[auto_auto_1fr_repeat(2,auto)] gap-3 mb-3 font-semibold'
    : 'grid grid-cols-subgrid col-span-full gap-3'
@endphp
@php
    $options = $division->options->pluck('property','code')
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
            <div class="flex-1 flex gap-3 items-center">
                {!! $has_menu ?  $division->name : $division->prefixLevel() . $division->name !!}
            </div>
            @if(!$division->is_approved)
                <div>
                    <x-lucide-triangle-alert class="w-6 text-red-700 bg-white" title="На модерации" />
                </div>
            @endif
        </div>
        <div class="flex gap-5 items-center justify-center flex-wrap w-16 2xl:w-auto bg-white p-3 rounded-sm shadow ">
            <a href="{{ $division->link }}" target="_blank" class="flex-end hover:text-green-700" title="Перейти на страницу">
                <x-lucide-square-arrow-out-up-right class="w-6"/>
            </a>

            <a href="{{ $division->cabinet_form }}" class="hover:text-amber-500" title="Редактировать">
                <x-lucide-square-pen class="w-6" />
            </a>


            @if(auth()->user()->isAdmin())
                <x-cabinet.elements.division-section-a
                    :link=" $division->user_access_cabinet_list "
                    lucide="user-round-cog"
                    :title=" __('common.allowed users') "
                    :options="$options"
                    option="has_gallery_in_moderation"
                />
            @endif

        </div>


        <div class="flex gap-5 items-center justify-center flex-wrap w-56 2xl:w-auto bg-white p-3 rounded-sm shadow ">
            <a href="{{ $division->documents_cabinet_list }}" class="flex-end hover:text-green-700" title="{{ __('common.Documents') }}">
                <x-lucide-files class="w-6"/>
            </a>

            <x-cabinet.elements.division-section-a
                :link=" $division->contacts_cabinet_list "
                lucide="phone"
                :title=" __('common.Contacts') "
                option="has_contacts_in_moderation"
                :options="$options"
            />

            <x-cabinet.elements.division-section-a
                :link=" $division->goals_cabinet_list "
                lucide="goal"
                :title=" __('common.Goals') "
                :options="$options"
                option="has_goals_in_moderation"
            />

            <x-cabinet.elements.division-section-a
                :link=" $division->partnersCabinetList() "
                lucide="handshake"
                :title=" __('common.Partners') "
                :options="$options"
                option="has_partners_in_moderation"
            />

            <x-cabinet.elements.division-section-a
                :link=" $division->careers_cabinet_list "
                lucide="id-card-lanyard"
                :title=" __('common.Careers') "
                :options="$options"
                option="has_careers_in_moderation"
            />

            <x-cabinet.elements.division-section-a
                :link=" $division->graduations_cabinet_list "
                lucide="graduation-cap"
                :title=" __('common.Graduations') "
                :options="$options"
                option="has_graduations_in_moderation"
            />

            <x-cabinet.elements.division-section-a
                :link=" $division->science_cabinet_list "
                lucide="microscope"
                :title=" __('common.Science') "
                :options="$options"
                option="has_science_in_moderation"
            />

            <x-cabinet.elements.division-section-a
                :link=" $division->history_form "
                lucide="file-clock"
                :title=" __('common.History') "
                :options="$options"
                option="has_history_in_moderation"
            />

            <x-cabinet.elements.division-section-a
                :link=" $division->achievements_form "
                lucide="file-badge"
                :title=" __('common.Achievements') "
                :options="$options"
                option="has_achievements_in_moderation"
            />

            <x-cabinet.elements.division-section-a
                :link=" $division->gallery_form "
                lucide="images"
                :title=" __('common.gallery') "
                :options="$options"
                option="has_gallery_in_moderation"
            />
        </div>
    </div>
@endif
