@props([
])
@php
    /** * @var object $item */
    $border = match(true){
            !$item->has_approval    => 'border-l-3 border-red-700 bg-white',
            !$item->is_show         => 'border-l-3 border-orange-300 bg-white',
            default                 => 'border-l-3 border-green-700 bg-white'
        };
@endphp

<div
    class="border-l-3 grid grid-cols-subgrid col-span-full gap-3"
>
    <div class="text-center p-3 rounded-sm shadow bg-white flex items-center {{ $border }}">
        {{ $item->id }}
    </div>
    <div class="flex flex-col xl:flex-row  justify-center gap-3 p-3 rounded-sm shadow bg-white items-center">
        <a href="{{ $item->cabinet_form }}" class="flex-end hover:text-green-700">
            <x-lucide-square-pen class="w-6"/>
        </a>
        <a href="{{ $item->link }}" target="_blank" class="flex-end hover:text-green-700">
            <x-lucide-square-arrow-out-up-right class="w-6"/>
        </a>
    </div>
    <div class="text-center p-3 rounded-sm shadow bg-white flex items-center">
        {!! $item->published_at->format('d-m-Y H:i') !!}
    </div>
    <div class=" p-3 rounded-sm shadow bg-white flex items-center">
        {{ $item->title }}
    </div>
    <div class="text-center p-3 rounded-sm shadow bg-white flex items-center">
        {{ $item->author->fio_short ?? null }}
    </div>
{{--    <div class="text-center flex-col p-3 rounded-sm shadow bg-white flex items-center">--}}
{{--        @foreach($item->categories as $category)--}}
{{--            <div>--}}
{{--                {{ $category->name }}--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--    <div class="text-center flex-col p-3 rounded-sm shadow bg-white flex items-center">--}}
{{--        @foreach($item->divisions as $division)--}}
{{--            <div>--}}
{{--                {{ $division->name }}--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
    <div class="px-2 justify-center p-3 rounded-sm shadow bg-white flex items-center">
        <x-html.button-delete-with-modal
            question="Удалить новость"
            :text=" $item->title "
            :action=" route('news.cabinet.delete', $item)"
            icoClass='hover:text-amber-700'
        />
    </div>
</div>
