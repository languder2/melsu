@props([
    'link'  => '#',
])
<a href="{{ $link }}">
    <x-lucide-chevron-down
        class="
            w-6 hover:bg-sky-700 hover:text-white cursor-pointer rounded-sm
            hover:shadow duration-300
            {{ $attributes->icoClass }}
        "
    />
</a>
