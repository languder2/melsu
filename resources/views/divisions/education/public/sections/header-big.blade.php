@props([
    'name'      => null,
    'image'     => null
])
@php
    if(!file_exists($image))
        $image = "img/faculties-headers/faculty-of-technical-sciences.webp";
@endphp
<section class="h-[400px] lg:h-[calc(100vh-160px)] 2xl:h-[900px] px-2.5 lg:p-0 relative bg-no-repeat bg-center lg:bg-top bg-cover flex"
         style="background-image: url({{asset($image)}})">
    <div class="bg-[rgba(40,13,13,0.6)] min-h-full min-w-full pointer-events-none absolute top-0 left-0">
    </div>
    <div class="container flex flex-row pt-25 lg:pt-0 justify-start items-end relative z-5 pb-5 lg:pb-10">
        <div class="2x:max-w-1/3">
            <h2 class="text-white font-bold text-2xl md:text-4xl 2xl:text-6xl">
                {{ $name }}
            </h2>
        </div>
    </div>
</section>
