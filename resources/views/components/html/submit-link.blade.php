@props([
    'text'      => null,
    'link'      => null,
    'inline'    => false,
    'target'    => '_self',
])

<a
    href="{{ $link }}"
    target="{{ $target }}"

    {{
        $attributes->class([
            'px-4',
            'py-2',
            $inline ? 'hover:text-white' : 'text-white bg-sky-900',
            'rounded-sm',
            'hover:bg-blue-700',
            'active:bg-gray-700',
            'cursor-pointer',
            'hover:mb-0.5 hover:-mt-0.5 duration-300',
            'hover:shadow-md hover:shadow-gray-400',
            'flex items-center'
        ])
    }}

    {{ $attributes->except('open') }}
>
    {{ $text }}
</a>
