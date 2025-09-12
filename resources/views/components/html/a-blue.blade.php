@if(!isset($href))
    @php
        $href ='#';
    @endphp
@endif

<a
    href="{{ $href }}"
    @class([
        'hover:text-red-700 hover:underline active:text-gray-700',
        str_contains(url()->current(), $href )
        ?"text-base-red"
        :"text-blue-900"
    ])

    @if(isset($blank))
        target="_blank"
    @endif
>
    {{$text ?? null}}
</a>
