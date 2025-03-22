@if($profile->placesByType($basis))
    <div class="flex-1">
        <div class="flex-1">
            <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                {{ $slot }}
            </h3>
            <p class="text-xl">
                {!! $profile->placesByType($basis) !!}
            </p>
        </div>
    </div>
@endif
