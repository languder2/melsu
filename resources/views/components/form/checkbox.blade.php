<div class="flex items-center py-4">
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
        @if(isset($checked))
            checked
        @endif
        class="
            w-4 h-4 text-baseRed bg-gray-100 border-gray-300 rounded
            focus:ring-baseRed focus:ring-2
            cursor-pointer
        "
        @if(old('_token'))
            @checked(old($name))
        @endif

        @if(isset($dataOptions))
            {!! $dataOptions !!}
        @endif
    >
    <label
        @if(isset($id))
            for     = "{{$id}}"
        @endif

        @class([
            'ms-2 text-sm font-medium text-gray-900',
            'cursor-pointer',
            &$class,
        ])
    >
        @if(isset($text))
            {{$text}}
        @endif
    </label>
</div>
