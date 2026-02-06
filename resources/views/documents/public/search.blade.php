@props([

])

<div class="document-search-main flex gap-1 mb-3">
    <div class="flex bg-white gap-2 p-3 flex-1 shadow">
        <x-lucide-search class="w-6 block group-open:hidden" />

        <input type="text" class="py-1 outline-0 border-b-1 w-full">

        <x-lucide-x class="w-6 cursor-pointer hover:text-hover-red search-clear" />
    </div>

    <div
        class="p-3 px-4 bg-base-red hover:bg-hover-red flex items-center cursor-pointer documentCategoriesShowAll"
        title="{{ __('messages.Show all categories') }}"
    >
        <x-lucide-list-chevrons-up-down
            class="w-6 text-white"
        />
    </div>

    <div class="p-3 px-4 bg-base-red hover:bg-hover-red flex items-center cursor-pointer documentCategoriesHideAll"
         title="{{ __('messages.Hide all categories') }}"
    >
        <x-lucide-list-chevrons-down-up
            class="w-6 text-white"
        />
    </div>
</div>
