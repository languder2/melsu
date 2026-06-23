@php
    $count = $profile->placesByType($basis)->count;
@endphp

@if($count)
    <div class="flex-1">
        <div class="flex-1">
            <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                {{ $slot }}
            </h3>
            <p class="text-xl">
                {!! $count !!}
            </p>
        </div>
    </div>
@endif
