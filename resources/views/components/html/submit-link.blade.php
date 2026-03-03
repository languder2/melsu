@props([
    'text'          => null,
    'link'          => null,
    'title'         => null,
    'inline'        => false,
    'target'        => '_self',
    'textStyles'    => null,
    'counter'       => null
])

<a
    href="{{ $link }}"
    target="{{ $target }}"

    {{
        $attributes->class([
            'px-4 py-2 relative',
            $inline ? 'hover:text-white' : 'text-white bg-sky-900',
            'shadow',
            'rounded-sm',
            'hover:bg-blue-700',
            'active:bg-gray-700',
            'cursor-pointer',
            'hover:mb-0.5 hover:-mt-0.5 duration-300',
            'hover:shadow-md hover:shadow-gray-400',
            'flex items-center gap-2 justify-between',
            'select-none',
        ])
    }}

    {{ $attributes->except('open') }}

    @if($title)
        title="{{ $title }}"
    @endif
>
    <span class="first-letter:uppercase {{ $textStyles }}">
        {!! $text !!}
    </span>

    @if(!is_null($counter))
        <span>
            [ {!! $counter !!} ]
        </span>
    @endif

    {{--    <span class="absolute -top-3 -right-3 rounded-full bg-red-800 text-white text-xs p-1">--}}
    {{--        123--}}
    {{--    </span>--}}
</a>
