@props([
    'link'      => '#',
    'lucide'    => null,
    'color'     => null,
    'text'      => null,

])

<a href="{{ $link }}" {{ $attributes }}
   class="text-center border py-4 px-6 flex flex-col gap-2 items-center w-40"
>
    @if($lucide)
        <x-dynamic-component
            component="{{ 'lucide-' . $lucide }}"
            class="w-20 {{ $color }} {{ !$text ? 'flex-grow flex items-center' : '' }}"
        />
    @endif

    @if($text)
        <span class="flex-grow flex items-center">
        {{ $text }}
    </span>
    @endif
</a>
