@props([
    'prefix'    => "slider-" . mt_rand(0, microtime(true)),
    'title'     => null,
    'slides'    => []
])

@php
    $slides = collect($slides ?? [])
@endphp

@if ($slides->isNotEmpty())
    <div class="editor-slider">
        <div class="slides w-full aspect-video relative">
            @foreach($slides as $i=>$slide)
                <x-html.modal.image
                    :url="$slide->url"
                    :id=" 'modal-img-slider-' . $prefix . '-slide-' . $i"
                    :open="!$i"
                    data-slide="{{ $i }}"
                    class="slide w-full h-full absolute inset-0 opacity-0 open:z-10 open:opacity-100 bg-gray-200 p-1 duration-1000 rounded-md shadow cursor pointer cursor-pointer focus:outline-none"
                />

            @endforeach
        </div>
        <div class="triggers overflow-hidden mt-2">
            <div class="grab-block flex gap-3 py-2 px-2px select-none">
                @foreach($slides as $i=>$slide)
                    <img
                        src="{{$slide->url}}" alt=""
                        @if(!$loop->index) open @endif
                        class="
                        trigger
                        grayscale-75 open:grayscale-0 hover:grayscale-0
                        border border-white
                        hover:-mt-1 hover:mb-1 duration-300 transition-[margin]
                        shadow-md shadow-indigo-500 open:shadow-red-800 hover:shadow-red-800
                        rounded-md
                        object-contain h-20 lg:h-32
                        cursor-pointer

                    "
                        data-slide="{{ $i }}"
                    >
                @endforeach
                <div class="opacity-0 ">
                    1
                </div>
            </div>
        </div>
    </div>
@endif
