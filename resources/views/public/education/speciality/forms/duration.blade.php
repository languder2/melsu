<h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
    Срок обучения
</h3>
<div class="text-xl">
    @if(!$profile->duration('SOO'))
        {{$profile->durationYear('OOO')}}
        {{$profile->durationMonth('OOO')}}
    @else
        <p class="flex gap-3 flex-row justify-between">
            <span>
                {{__('duration-append.after_9')}}
            </span>
            <span class="font-semibold">
                {{$profile->durationYear('SOO')}}
                {{$profile->durationMonth('SOO')}}
            </span>
        </p>
        <p class="flex gap-3 flex-row justify-between">
            <span>
                {{__('duration-append.after_11')}}
            </span>
            <span class="font-semibold">
                {{$profile->durationYear('OOO')}}
                {{$profile->durationMonth('OOO')}}
            </span>
        </p>
    @endif




</div>
