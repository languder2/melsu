@props([
    'block'         => null,
    'name'          => null,
    'default'       => null,
    'id'                => 'form-' . \Illuminate\Support\Str::random(20),
    'value'         => null,
    'checked'       => null,
    'class'         => null,
    'label'         => null,
    'checkbox'      => null,
])

<div @class([
    "flex items-center pt-4",
    $block

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

        value = "{{ $value ?? 'on'}}"

        class="
            w-4 h-4 text-baseRed bg-gray-100 border-gray-300 rounded
            focus:ring-blue-700 focus:ring-2
            active:ring-blue-700
            cursor-pointer
            outline-0

            {{ $checkbox }}
        "
            @checked( $checked ?? null )
    >
    <label
        @isset($id)
            for = "{{$id}}"
        @endisset

        @class([
            'ms-2 cursor-pointer select-none',
            $class ?? null
        ])
    >
        @isset( $label )
            {{ $label }}
        @endisset
    </label>
</div>
