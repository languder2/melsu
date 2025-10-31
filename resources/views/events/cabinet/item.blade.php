@props([
    'item' => (object)[
        'id'                => 'id',
        'title'             => 'Название',
        'event_datetime'    => 'Дата и время',
        'author'            => 'Автор',
        'has_approval'      => false,
        'is_show'           => false
    ],
    'isHeader'  => false,
    'class'     => null,
])

<div
    class="
        @if($isHeader)
            sticky top-0 bg-sky-800 text-white
        @elseif(!$isHeader && !$item->has_approval)
            bg-red-800 text-white
        @elseif(!$isHeader && !$item->is_show)
            bg-amber-500 text-white
        @else
            bg-white
        @endif
        grid grid-cols-subgrid col-span-full gap-3 p-4 rounded-sm shadow items-center
    "
>
    <div class="text-center">
        {{ $item->id }}
    </div>
    <div class="px-2 flex justify-center">
        @if(!$isHeader)
            <a href="{{ $item->cabinet_form_link }}" class="flex-end hover:text-green-700">
                <x-lucide-square-pen class="w-6"/>
            </a>
        @endif
    </div>
    <div>
        {{ $item->title }}
    </div>
    <div class="px-2 flex justify-center">
        @if(!$isHeader)
            <a href="{{ $item->show_link }}" target="_blank" class="flex-end hover:text-green-700">
                <x-lucide-square-arrow-out-up-right class="w-6"/>
            </a>
        @endif
    </div>
    <div class="text-center">
        {{ $isHeader ? $item->event_datetime : $item->event_datetime->format('d.m.Y H:i') }}
    </div>
    <div class="text-center">
        {{ $isHeader ? $item->author : $item->author->name ?? null }}
    </div>
    <div class="px-2 flex justify-center">
        @if(!$isHeader)
            <x-html.button-delete-with-modal
                question="Удалить мероприятие"
                :text=" $item->title "
                :action=" $item->cabinet_delete_link "
                icoClass='hover:text-amber-700'
            />
        @endif
    </div>
</div>
