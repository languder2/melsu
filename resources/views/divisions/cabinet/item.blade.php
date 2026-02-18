@props([
    'has_menu'      => false,
    'division'      => new \App\Models\Division\Division(),
    'isAdmin'       => auth()->user() ? auth()->user()->isAdmin() : false,
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
        @if($isAdmin)
            <div class="flex items-center justify-center p-3 rounded-sm shadow bg-white">
                <x-html.button-delete-with-modal
                    question="Удалить подразделение"
                    :text=" $division->name "
                    :action=" $division->delete "
                    icoClass='hover:text-amber-700'
                />
            </div>
        @endif
        <div class=" flex items-center justify-center p-3 rounded-sm shadow bg-white {{ $isAdmin ? '' : 'col-span-2' }}">
            {!! $division->id !!}
        </div>


        @if($division->hasCacheCabinetItem())
            {!! $division->getCacheCabinetItem() !!}
        @else
            @component('divisions.cabinet.item-line', compact('has_menu', 'division'))@endcomponent
        @endif
    </div>
@endif
