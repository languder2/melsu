@props([
    'isFirst'   => false,
    'isLast'    => false,
    'current'   => new \App\Models\Documents\Document()
])
@php
    /** * @var object $current */
    $classes = match(true){
            !$current->is_approved     => 'border-red-700 bg-white',
            !$current->is_show         => 'border-orange-400 bg-white',
            default                 => 'border-white bg-white'
        };
@endphp
<div
    class="grid grid-cols-subgrid col-span-full gap-3"
>


    <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
        <x-html.button-delete-with-modal
            question="Удалить цель"
            :text=" $current->title "
            :action=" route('documents.cabinet.delete', compact('current')) "
            icoClass='hover:text-amber-700'
        />
    </div>
    <div class="bg-white rounded-sm p-3 shadow flex items-center justify-center">
        {{ $current->id }}
    </div>
    <div class="bg-white rounded-sm p-3 shadow flex gap-3">
        @if($current->parent_id) <div class="ps-3">⤷</div> @endif
        <div>
            {{ $current->title }}
        </div>
        <div class="flex-1"></div>
        <div>
            {{ $current->sort }}
        </div>
    </div>

    <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
        <a href="{{ $current->link }}" target="_blank" class="flex-end hover:text-green-700" title="Перейти на страницу">
            <x-lucide-square-arrow-out-up-right class="w-6"/>
        </a>
    </div>

    <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
        <a href="{{ route('documents.cabinet.form', compact('current')) }}" class="flex-end hover:text-green-700">
            <x-lucide-square-pen class="w-6"/>
        </a>

        @unless($current->parent_id)
            <a href="{{ route('documents.cabinet.form', ['category' => $current->category, 'parent' => $current->id ]) }}" class="flex-end hover:text-green-700">
                <x-lucide-square-plus class="w-6"/>
            </a>
        @endunless
    </div>

    <div class="flex justify-center gap-2 items-center bg-white rounded-sm p-3 shadow">
        @if(!$isLast)
            <x-html.button-change-sort-down
                :link=" route('documents.cabinet.change-sort', [$current, 'down']) "
            />
        @endif
        @if(!$isFirst)
            <x-html.button-change-sort-up
                :link=" route('documents.cabinet.change-sort', [$current, 'up']) "
            />
        @endif
    </div>
</div>

@if(!$current->parent_id)
    @foreach($current->subs as $document)
        @component('documents.cabinet.document',[
            'current'   => $document,
            'isFirst'   => $loop->first,
            'isLast'    => $loop->last,
        ])@endcomponent
    @endforeach
@endif
