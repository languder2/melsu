@props([
    'item'  => null,
])
@if($item)
    <div class="flex gap-3">
        <div class="relative pt-1">
            <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
            <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
        </div>
        <p>
            {!! $item !!}
        </p>
    </div>
@endif
