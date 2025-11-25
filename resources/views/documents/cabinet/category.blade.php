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
    class="grid grid-cols-subgrid col-span-full gap-3 "
>
    <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
        <x-html.button-delete-with-modal
            question="Удалить цель"
            :text=" $item->name "
            :action=" $item->delete "
            icoClass='hover:text-amber-700'
        />
    </div>
    <div class="p-3 font-semibold bg-sky-900 text-white">
        {{ $item->name }}
    </div>
    <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
        <a href="{{ $item->cabinetForm() }}" class="flex-end hover:text-green-700">
            <x-lucide-square-pen class="w-6"/>
        </a>

        {{--        <a href="{{ $item->cabinetForm() }}" class="flex-end hover:text-green-700">--}}
        {{--            <x-lucide-list-tree class="w-6"/>--}}
        {{--        </a>--}}
        <a href="{{ $item->partnerAdd }}" class="flex-end hover:text-green-700">
            <x-lucide-square-plus class="w-6"/>
        </a>
    </div>
    <div class="flex justify-center gap-2 bg-white rounded-sm items-center p-3 shadow">
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
<div class="col-span-full grid grid-cols-[auto_1fr_auto_auto] gap-3">

    @forelse($item->partners as $partner)
        @component('partners.cabinet.partner',[
            'item'      => $partner,
            'isFirst'   => $loop->first,
            'isLast'    => $loop->last,
        ])@endcomponent
    @empty
        <div class="p-3 bg-white shadow col-span-full text-center">
            Нет партнеров
        </div>
    @endforelse
</div>
<hr class="col-span-full last:hidden my-2">
