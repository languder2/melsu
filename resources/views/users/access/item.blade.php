@props([
])
<div
    class="border-l-3 grid grid-cols-subgrid col-span-full gap-3 p-4 rounded-sm shadow items-center select-none border-white bg-white"
>
    <div class="text-center">
        {{ $item->id }}
    </div>
    <div>
        {!! $item->email !!}
    </div>
    <div>
        {!! $item->fio !!}
    </div>
    <div>
        {!! $item->role->label() !!}
    </div>
    </div>
