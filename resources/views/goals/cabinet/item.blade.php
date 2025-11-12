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
    class="border-l-3 grid grid-cols-subgrid col-span-full gap-3 p-4 rounded-sm shadow items-center select-none {{ $classes }}"
>
    <div class="text-center">
        {{ $item->id }}
    </div>
    <div>
        {!! $item->content_html !!}
    </div>
    <div class="flex flex-col justify-center gap-6">
        <a href="{{ $item->cabinet_form }}" class="flex-end hover:text-green-700">
            <x-lucide-square-pen class="w-6"/>
        </a>
        <x-html.button-delete-with-modal
            question="Удалить цель"
            :text=" $item->content_html "
            :action=" $item->delete "
            icoClass='hover:text-amber-700'
        />
    </div>
    <div class="flex flex-col justify-center gap-6">
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
