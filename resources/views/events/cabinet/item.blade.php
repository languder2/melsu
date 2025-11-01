@props([
])
@php
    /** * @var object $item */
    $classes = match(true){
            !$item->has_approval    => 'border-red-700 bg-white',
            !$item->is_show         => 'border-orange-400 bg-white',
            default                 => 'border-white bg-white'
        };
@endphp

<div
    class="border-l-3 grid grid-cols-subgrid col-span-full gap-3 p-4 rounded-sm shadow items-center {{ $classes }}"
>
    <div class="text-center">
        {{ $item->id }}
    </div>
    <div class="flex flex-col xl:flex-row justify-center gap-3">
        <a href="{{ $item->cabinet_form_link }}" class="flex-end hover:text-green-700">
            <x-lucide-square-pen class="w-6"/>
        </a>
        <a href="{{ $item->show_link }}" target="_blank" class="flex-end hover:text-green-700">
            <x-lucide-square-arrow-out-up-right class="w-6"/>
        </a>
    </div>
    <div class="text-center">
        {{ $item->event_datetime->format('d.m.Y') }}
        {{ $item->event_datetime->format('H:i') }}
    </div>
    <div>
        {{ $item->title }}
    </div>
    <div class="text-center">
        {{ $item->author->name ?? null }}
    </div>
    <div class="text-center">
        {{ $item->category->name ?? null }}
    </div>
    <div class="text-center">
        {{ $item->relation->name ?? null }}
    </div>
    <div class="px-2 flex justify-center">
        <x-html.button-delete-with-modal
            question="Удалить мероприятие"
            :text=" $item->title "
            :action=" $item->cabinet_delete_link "
            icoClass='hover:text-amber-700'
        />
    </div>
</div>
