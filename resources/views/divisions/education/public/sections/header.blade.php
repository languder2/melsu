@props([
    'name'      => null,
    'image'     => null,
    'contacts'  => collect()
])
@php
    if(is_null($image))
        $image = asset("img/faculties-headers/faculty-of-technical-sciences.webp");
@endphp
<section
    class="h-100 lg:h-150 px-3 lg:p-0 relative bg-no-repeat lg:bg-top bg-cover flex"
    style="background-image: url( {{ $image }} ); background-position: center center;"
>
    <div class="bg-[rgba(40,13,13,0.6)] min-h-full min-w-full pointer-events-none absolute top-0 left-0">
    </div>
    <div class="container flex flex-row pt-25 lg:pt-0 justify-start items-end relative z-5 pb-5 lg:pb-10">
        <div class="2x:max-w-1/3">
            <h2 class="text-white font-bold text-2xl md:text-4xl 2xl:text-6xl">
                {{ $name }}
            </h2>
        </div>
        @if($contacts->isNotEmpty())
            <div class="text-white">



            </div>
        @endif
    </div>
</section>
