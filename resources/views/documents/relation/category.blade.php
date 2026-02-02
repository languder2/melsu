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
    class="grid grid-cols-subgrid col-span-full gap-3 group"
>

    <div
        class="grid grid-cols-subgrid col-span-full gap-3"
    >
        <input id="category{{ $item->id }}" type="checkbox" class="hidden">

        <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
            <x-html.button-delete-with-modal
                :question=" __('common.remove category')"
                :text=" $item->name "
                :action=" route('documents-category.relation.delete', [$item->relation->getTable(), $item->relation, $item]) "
                icoClass='hover:text-amber-700'
            />
        </div>
        <div class="p-3 font-semibold bg-sky-900 text-white flex gap-x-3">
            @if(auth()->user()->isEditor())
                <span>
                {{ $item->id }}
            </span>
            @endif
            <span>
            {{ $item->name }}
        </span>
            <span class="flex-auto"></span>
            <span>
            {{ $item->sort }}
        </span>
        </div>
        <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
            <a
                href="{{ route('documents-category.relation.form', [$item->relation->getTable(), $item->relation, $item]) }}"
                class="flex-end hover:text-green-700"
            >
                <x-lucide-square-pen class="w-6"/>
            </a>

            <a href="{{ route('documents.relation.form', [$item->relation->getTable(), $item->relation,'category' => $item]) }}" class="flex-end hover:text-green-700">
                <x-lucide-square-plus class="w-6"/>
            </a>

            <label for="category{{ $item->id }}" class="cursor-pointer">
                <x-lucide-list-chevrons-down-up title="{{ __('messages.Show documents') }}" class="w-6 block group-has-checked:hidden"/>
                <x-lucide-list-chevrons-up-down title="{{ __('messages.Hide documents') }}" class="w-6 hidden group-has-checked:block"/>
            </label>

        </div>
        <div class="flex justify-center gap-2 bg-white rounded-sm items-center p-3 shadow">
            @if(!$isFirst)
                <x-html.button-change-sort-up
                    :link=" route('documents-categories.relation.change-sort', [
                    \App\Enums\Entities::getEntityByModel($item->relation::class)->value,
                    $item->relation->id,
                    $item->id,
                    'up'
                ]) "
                />
            @endif

            @if(!$isLast)
                <x-html.button-change-sort-down
                    :link=" route('documents-categories.relation.change-sort', [
                    \App\Enums\Entities::getEntityByModel($item->relation::class)->value,
                    $item->relation->id,
                    $item->id,
                    'down'
                ]) "
                />
            @endif
        </div>
    </div>

    <div class="col-span-full grid-cols-[auto_1fr_auto_auto] gap-3 hidden group-has-checked:grid">
        @forelse($item->documents->filter(fn($document) => $item->relation->is($document->relation)) as $document)
            <div class="p-3 border-1 col-span-full grid grid-cols-subgrid gap-4 bg-neutral-200 rounded-sm">
                @component('documents.relation.document',[
                    'item'      => $document,
                    'isFirst'   => $loop->first,
                    'isLast'    => $loop->last,
                ])@endcomponent
            </div>
        @empty
            <div class="p-3 bg-white shadow col-span-full text-center">
                Нет документов
            </div>
        @endforelse
    </div>
</div>
