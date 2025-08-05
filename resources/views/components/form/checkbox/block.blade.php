<div @class([
    "flex items-center pt-4",
    $block ?? null

])>

    @isset($default)
        <input type="hidden" name="{{ $name }}" value="{{ $default }}">
    @endisset

    <input
        @if(isset($id))
            id = "{{ $id }}"
        @endif

        name = "{{$name}}"
        type="checkbox"

        @if(isset($value))
            value = "{{$value}}"
        @endif
        class="
            w-4 h-4 text-baseRed bg-gray-100 border-gray-300 rounded
            focus:ring-blue-700 focus:ring-2
            active:ring-blue-700
            cursor-pointer
            outline-0
        "
            @checked( $checked ?? null )
    >
    <label
        @isset($id)
            for = "{{$id}}"
        @endisset

        @class([
            'ms-2 text-gray-900 cursor-pointer',
            $class ?? null
        ])
    >
        @isset( $label )
            {{ $label }}
        @endisset
    </label>
</div>
