@props([
    'id'                => 'form-' . \Illuminate\Support\Str::random(20),
    'type'              => 'submit',
    'name'              => null,
    'value'             => null,
])

    <input
        type="{{ $type }}"
        id="{{ $id }}"

        name="{{$name}}"

        value="{{ $value }}"

        {{
            $attributes->class([
                'px-4',
                'py-2',
                'text-white',
                'rounded-sm',
                'bg-blue-900',
                'hover:bg-blue-700',
                'active:bg-gray-700',
                'cursor-pointer',
                'hover:mb-0.5 hover:-mt-0.5 duration-300',
                'hover:shadow-md hover:shadow-gray-400'
            ])
        }}

        {{ $attributes }}
    >
