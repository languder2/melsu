<div class="flex items-center">
    <input
        @if(isset($id))
            id      = "{{$id}}"
        @endif
        @if(isset($name))
            name    = "{{$name}}"
        @endif
        type="checkbox"
        @if(isset($value))
            value   = "{{$value}}"
        @endif
        class="
            w-4 h-4 text-baseRed bg-gray-100 border-gray-300 rounded
            focus:ring-blue-700 focus:ring-2
            active:ring-blue-700
            cursor-pointer
            outline-0
        "
            @checked($checked)
    >
    <label
        @if(isset($id))
            for     = "{{$id}}"
        @endif

        @class([
            'ms-2 text-gray-900',
            'cursor-pointer',
            &$class,
        ])
    >
        @if(isset($text))
            {{$text}}
        @endif
    </label>
</div>
