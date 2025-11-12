@props([
    'prefix'    => "slider-" . mt_rand(0, microtime(true)),
    'title'     => null,
    'slides'    => []
])

@php
    $slides = collect($slides ?? [])
@endphp

@if ($slides->isNotEmpty())
    <div class="flex flex-col lg:flex-row gap-3 justify-center-safe">
        @foreach($slides as $i=>$image)
            <x-html.modal.image
                :url="$image->url"
                :id="'modal-img-slider-' . $prefix . '-slide-' . $i"
                :open="!$i"
                data-slide="{{ $i }}"
                class="cursor-pointer flex-auto focus:outline-none"
                object="object-cover"
            />
        @endforeach
    </div>
@endif




