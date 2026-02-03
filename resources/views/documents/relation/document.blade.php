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
            :text=" $item->title "
            :action=" route('documents.relation.delete', $item) "
            icoClass='hover:text-amber-700'
        />
    </div>
    <div class="bg-white rounded-sm p-3 shadow flex items-center">
        {{ $item->id }}
    </div>
    <div class="bg-white rounded-sm p-3 shadow flex gap-3">
        @if($item->parent_id) <div class="ps-3">⤷</div> @endif
        <div>
            {{ $item->title }}
        </div>
{{--        <div class="flex-1"></div>--}}
{{--        <div>--}}
{{--            {{ $item->sort }}--}}
{{--        </div>--}}
    </div>

    <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
        <a href="{{ $item->link }}" target="_blank" class="flex-end hover:text-green-700" title="Перейти на страницу">
            <x-lucide-square-arrow-out-up-right class="w-6"/>
        </a>
    </div>

    <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
        <a href="{{ route('documents.relation.form', [$item->relation->getTable(), $item->relation, $item]) }}" class="flex-end hover:text-green-700">
            <x-lucide-square-pen class="w-6"/>
        </a>

        @unless($item->parent_id)
            <a href="{{ route('documents.relation.form', [$item->relation->getTable(), $item->relation,'category' => $item->category_id, 'parent' => $item->id ]) }}" class="flex-end hover:text-green-700">
                <x-lucide-square-plus class="w-6"/>
            </a>
        @endunless
    </div>

    <div class="flex justify-center gap-2 items-center bg-white rounded-sm p-3 shadow">
        @if(!$isLast)
            <x-html.button-change-sort-down
                :link=" route('documents.relation.change-sort', [$item, 'down']) "
            />
        @endif
        @if(!$isFirst)
            <x-html.button-change-sort-up
                :link=" route('documents.relation.change-sort', [$item, 'up']) "
            />
        @endif
    </div>
</div>

@if(!$item->parent_id)
    @foreach($item->subs as $document)
        @component('documents.relation.document',[
            'item'      => $document,
            'isFirst'   => $loop->first,
            'isLast'    => $loop->last,
        ])@endcomponent
    @endforeach
@endif
