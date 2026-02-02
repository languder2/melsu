@props([
    'prefix'    => "slider-" . mt_rand(0, microtime(true)),
    'title'     => null,
    'slides'    => []
])

@php
    $slides = collect($slides ?? [])
@endphp

@if ($slides->isNotEmpty())
    <div class="flex gap-3 flex-wrap justify-center">
        @foreach($slides as $i=>$slide)
            <div class="h-72">
                <x-html.modal.image
                    :url="$slide->url"
                    :id=" 'modal-img-slider-' . $prefix . '-slide-' . $i"
                    :open="!$i"
                    data-slide="{{ $i }}"
                    class="h-full w-full"
                />
            </div>
        @endforeach
    </div>
@endif
