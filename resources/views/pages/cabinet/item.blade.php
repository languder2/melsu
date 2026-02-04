@props([
    'item'      => new \App\Models\Page\Page(),
    'has_menu'  => false,

])
@php
    /** * @var object $item */
    $template = $has_menu ? 'grid-cols-[auto_1fr_auto_auto_auto] mb-3' : 'grid-cols-subgrid'
@endphp

<div
    class="grid {{ $template }} col-span-full gap-3 items-center"
>
    <div class="text-center p-3 rounded-sm shadow bg-white">
        {{ $item->id }}
    </div>
    <div class="p-3 rounded-sm shadow bg-white">
        {{ $item->name }}
    </div>
    <div class="flex justify-center gap-4 p-3 px-4 rounded-sm shadow bg-white">
        <a href="{{ $item->cabinet_form_link }}" class="flex-end hover:text-green-700">
            <x-lucide-square-pen class="w-6"/>
        </a>
        <a href="{{ $item->link }}" target="_blank" class="flex-end hover:text-green-700">
            <x-lucide-square-arrow-out-up-right class="w-6"/>
        </a>
    </div>
    <div class="flex justify-center gap-4 p-3 px-4 rounded-sm shadow bg-white {{ auth()->user()->isEditor() ? '' : 'col-span-2' }}">
        <x-cabinet.elements.division-section-a
            :link=" $item->user_access_cabinet_list "
            lucide="user-round-cog"
            :title=" __('common.allowed users') "
            :isApproved="true"
            option="has_gallery_in_moderation"
        />

        <a href="{{ route('documents.relation.list', [$item->getTable(), $item->id]) }}" class="flex-end hover:text-green-700" title="{{ __('common.Documents') }}">
            <x-lucide-files class="w-6"/>
        </a>
    </div>
    @if(auth()->user()->isEditor())
        <div class="flex justify-center gap-4 p-3 px-4 rounded-sm shadow bg-white">
            <x-html.button-delete-with-modal
                question="Удалить страницу"
                :text=" $item->title "
                :action=" $item->cabinet_delete_link "
                icoClass='hover:text-amber-700'
            />
        </div>
    @endif
</div>
