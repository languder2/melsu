@props([
    'isFirst'   => false,
    'isLast'    => false,
    'item'
])
@php
    /** * @var object $item */
    $classes = match(true){
            !$item->is_approved     => 'border-red-700 bg-white',
            !$item->is_show         => 'border-orange-400 bg-white',
            default                 => 'border-white bg-white'
        };
@endphp

<div
    class="grid grid-cols-subgrid col-span-full gap-3"
>
    <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
        <x-html.button-delete-with-modal
            question="Удалить цель"
            :text=" $item->name "
            :action=" $item->delete "
            icoClass='hover:text-amber-700'
        />
    </div>
    <div class="bg-white rounded-sm p-3 shadow">
        {{ $item->sort }}
        {{ $item->name }}
    </div>

    <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
        <a href="{{ $item->form }}" class="flex-end hover:text-green-700">
            <x-lucide-square-pen class="w-6"/>
        </a>
    </div>

    <div class="flex justify-center gap-2 items-center bg-white rounded-sm p-3 shadow">
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
