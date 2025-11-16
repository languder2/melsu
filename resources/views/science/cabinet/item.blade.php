@props([
    'isFirst'   => false,
    'isLast'    => false,
    'item'
])
@php
    /** * @var object $item */
    $classes = match(true){
            !$item->is_approved     => 'bg-red-700 text-white',
            !$item->is_show         => 'bg-amber-600 text-white',
            default                 => 'bg-white'
        };
@endphp

<div
    class="grid grid-cols-subgrid col-span-full gap-3"
>
    <div class="text-center p-3 px-5 rounded-sm shadow flex items-center select-none {{ $classes }}">
        {{ $item->id }}
    </div>

    <div class="p-3 bg-white rounded-sm shadow flex items-center">
        {{ $item->name }}
    </div>

    <div class="flex flex-col lg:flex-row justify-center gap-6 lg:gap-4 p-3 bg-white rounded-sm shadow items-center">

        <a href="{{ $item->cabinet_form }}" class="flex-end hover:text-green-700">
            <x-lucide-square-pen class="w-6"/>
        </a>

        <x-html.button-delete-with-modal
            question="Удалить цель"
            :text=" $item->name "
            :action=" $item->delete "
            icoClass='hover:text-amber-700'
        />
    </div>
    <div class="flex flex-col lg:flex-row justify-center gap-6 lg:gap-4 p-3 bg-white rounded-sm shadow items-center">

        @if(!$isFirst)
            <x-html.button-change-sort-up
                :link=" $item->sort_up "
            />
        @endif

        @if(!$isLast)
            <x-html.button-change-sort-down
                :link=" $item->sort_down "
            />
        @endif
    </div>
</div>
