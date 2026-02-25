@props([
    'isFirst'   => false,
    'isLast'    => false,
    'current'   => new \App\Models\Documents\DocumentCategory()
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
    class="grid grid-cols-subgrid col-span-full gap-x-3 group"
>
    <div
        class="grid grid-cols-subgrid col-span-full gap-3 sticky top-16 bg-neutral-100 py-2 z-30 "
    >
        <input
            id="category{{ $current->id }}"
            value="showDocumentCategory{{ $current->id }}"
            type="checkbox"
            class="hidden showDocumentCategory"
            @checked(Session::has("showDocumentCategory{$current->id}"))
        >

        <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
            <x-html.button-delete-with-modal
                :question=" __('common.remove category')"
                :text=" $current->name "
                :action=" route('documents.cabinet.category.delete', compact('current')) "
                icoClass='hover:text-amber-700'
            />
        </div>

        <div class="p-3 font-semibold bg-sky-900 text-white rounded-sm text-center">
            {{ $current->id }}
        </div>

        <div class="p-3 font-semibold bg-sky-900 text-white rounded-sm flex gap-4">
            <div>
                {{ $current->name }}
            </div>
            <div class="flex-1"></div>
            <div>
                {{ __('common.Documents').": ". $current->allPublicDocuments()->count() . " / " . $current->allDocuments->count() }}
            </div>
            @if($current->option('in_accordion')->exists)
                <div class="flex gap-4 items-center">
                    <x-lucide-layers class="w-6"/>
                    {{ $current->option('accordion_prefix')->property }}
                </div>
            @endif
        </div>

        <div class="flex justify-center gap-4 bg-white rounded-sm items-center p-3 shadow">
            <a
                href="{{ route('documents.cabinet.category.form', compact('current')) }}"
                class="flex-end hover:text-green-700"
            >
                <x-lucide-square-pen class="w-6"/>
            </a>

            <a href="{{ route('documents.cabinet.form', ['category' => $current]) }}" class="flex-end hover:text-green-700">
                <x-lucide-square-plus class="w-6"/>
            </a>

        </div>

        <label for="category{{ $current->id }}" class="cursor-pointer p-3 font-semibold bg-white rounded-sm">
            <x-lucide-list-chevrons-down-up
                title="{{ __('messages.Show documents') }}"
                class="w-6 hidden group-has-checked:block hover:text-green-700"
            />
            <x-lucide-list-chevrons-up-down
                title="{{ __('messages.Hide documents') }}"
                class="w-6 block group-has-checked:hidden hover:text-green-700"
            />
        </label>

        <div class="flex justify-center gap-2 bg-white rounded-sm items-center p-3 shadow">
            @if(!$isLast)
                <x-html.button-change-sort-down
                    :link=" route('documents.cabinet.category.change-sort', [
                    $current->id,
                    'down'
                ]) "
                />
            @endif
            @if(!$isFirst)
                <x-html.button-change-sort-up
                    :link=" route('documents.cabinet.category.change-sort', [
                    $current->id,
                    'up'
                ]) "
                />
            @endif
        </div>
    </div>

    <div class="col-span-full grid-cols-[auto_auto_1fr_auto_auto_auto] gap-3 hidden group-has-checked:grid">
        @forelse($current->documents as $document)
            <div class="p-3 border-1 col-span-full grid grid-cols-subgrid gap-4 bg-neutral-200 rounded-sm">
                @component('documents.cabinet.document',[
                    'current'   => $document,
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
