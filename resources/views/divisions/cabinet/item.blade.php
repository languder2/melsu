@php
    /** * @var object $division */
    $classes = match(true){
//            !$division->has_approval    => 'border-red-700 bg-white',
            !$division->show        => 'border-orange-400 bg-white',
            default                 => 'border-white bg-white'
        };
@endphp

<div
    class="border-l-3 grid grid-cols-subgrid col-span-full gap-3 p-4 rounded-sm shadow items-center {{ $classes }}"
>

    <div class=" flex items-center justify-center">
        {!! $division->level + 1 !!}
    </div>

    <div class=" flex items-center justify-center">
        {!! $division->id !!}
    </div>

    <div class="flex gap-3 items-center">

        @for($i=1; $i <= $division->level; $i++)
            <span class="px-1"></span>
        @endfor

        @if($division->level)
            <x-lucide-corner-down-right class="w-4" />
        @endif

        {!! $division->name !!}
    </div>

    <div class="flex gap-3 items-center">
        <a href="{{ $division->link }}" target="_blank" class="flex-end hover:text-green-700">
            <x-lucide-square-arrow-out-up-right class="w-6"/>
        </a>
    </div>

    <div class="flex gap-6 px-4">
        <div class="flex items-center justify-center">
            <a href="{{ $division->cabinet_form }}" class="hover:text-amber-500">
                <x-lucide-square-pen class="w-6" />
            </a>
        </div>

        <form action="{{ route('news.cabinet.set-filter') }}" method="post">
            @csrf
            <input type="hidden" name="setFilter[division]" value="{{ $division->id }}">
            <label class="flex gap-3">
                <x-lucide-notepad-text class="w-6 hover:text-amber-500 cursor-pointer"/>
                <input type="submit" class="hidden">
            </label>
        </form>
    </div>
</div>
