<button
    @class([
        "
            bg-blue-900
            px-4 py-2
            text-white
            rounded-md
            hover:bg-blue-700
            active:bg-gray-700
            transition-all duration-200
            hover:bg-green-800
            hover:-mt-2px hover:mb-2px
            hover:shadow-md hover:shadow-gray-400

        ",
        $class ?? null
    ])
>
    {{$slot}}
</button>
