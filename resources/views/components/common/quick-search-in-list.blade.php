@props([
    'blockID'       => null,
    'placeholder'   => __('labels.Search')

])

<div class="flex bg-white gap-2 p-3 flex-1 shadow">
    <x-lucide-search class="w-6 block" />

    <input
        name="quickSearchInList"
        type="text"
        class="py-1 outline-0 border-b-1 w-full"
        data-search-block="#{{ $blockID }}"
        placeholder="{{ $placeholder }}"
    >

    <x-lucide-x class="w-6 cursor-pointer hover:text-hover-red search-clear" />
</div>
