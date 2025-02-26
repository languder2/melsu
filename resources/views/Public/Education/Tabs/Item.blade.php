<a
    href="{{$href ?? '#'}}"
    @class([
        "
            relative pb-2 my-2 px-8
            border-b-2 font-semibold
            transition-all duration-200

            after:absolute
            after:h-2px
            after:transition-all
            after:duration-200
            after:-bottom-2px
        ",
        $active
        ?'after:inset-x-0 after:bg-gray-700':
        'opacity-40 hover:opacity-100 after:inset-x-1/2 hover:after:inset-x-0 hover:after:bg-gray-700'
    ])
>
    {{$text ?? null}}
</a>
