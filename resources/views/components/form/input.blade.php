@props([
    'heading'           => null,
    'id'                => null,
    'initialContent'    => json_encode(['blocks' => []]),
    'type'              => 'text',
    'name'              => null,
    'label'             => null,
    'value'             => '',
    'required'          => false,
    'disabled'          => null,
    'data'              => []
])

@php
    $id = $id ?? 'form-' . \Illuminate\Support\Str::random(10);
@endphp

<div class="block relative mt-2 {{ $attributes->get('block') }} group-has-disabled:opacity-30 duration-200">
    <input
        type="{{ $type }}"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        class="
            border-b border-dashed bg-none outline-0 w-full py-1 mt-2 peer autofill:text-pink-800 focus:text-blue-700 focus:border-blue-700
            {{ $attributes->get('class') }}
        "
        @disabled( $disabled )
        @required( $required )
        placeholder=" "

        {{ $attributes->except(['class', 'block', 'labelClass', 'labelBlock']) }}

        @foreach($data as $key => $item)
            data-{{ $key }}="{{ $item }}"
        @endforeach
    >

    @if( $label )
        <label
            for="{{ $id }}"
            class="
                absolute
                left-0
                duration-200
                pointer-events-none

                top-4
                text-base
                text-gray-950

                peer-focus:text-xs
                peer-focus:top-0
                peer-focus:text-blue-700

                peer-[:not(:placeholder-shown)]:text-xs
                peer-[:not(:placeholder-shown)]:top-0
                peer-[:not(:placeholder-shown)]:text-gray-500

                peer-autofill:text-xs
                peer-autofill:top-0
                peer-disabled:opacity-50
                {{ $attributes->get('labelClass') ?? $attributes->get('labelBlock') }}
            "
        >
            {{ $label . ($required ? ' *' : '') }}
        </label>
    @endif
</div>
