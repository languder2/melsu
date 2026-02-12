@props([
    'heading'           => null,
    'id'                => 'form-' . \Illuminate\Support\Str::random(20),
    'initialContent'    => json_encode(['blocks' => []]),
    'type'              => 'text',
    'name'              => null,
    'label'             => null,
    'value'             => '',
    'required'          => false,
    'disabled'          => null,
    'data'              => []
])

<div class="block relative mt-2 {{ $attributes->get('block') }} group-has-disabled:opacity-30 duration-200 ">
    <input
        type="{{ $type }}"
        id="{{ $id }}"

        name="{{ $name }}"
        value="{{ $value }}"

        class="
            border-b border-dashed bg-none outline-0 w-full py-2 mt-2 peer autofill:text-pink-800 focus:text-blue-700 focus:border-blue-700
            {{ $attributes->get('class') }}
        "

        @disabled( $disabled )

        {{ $attributes->except(['class','block', 'labelClass']) }}

        @foreach($data as $key=>$item)
            data-{{$key}}="{{ $item }}"
        @endforeach

        @required( $required )

        placeholder=""
    >

    @if( $label )
        <label
            for="{{ $id }}"
            class="
                absolute
                left-0
                top-0
                text-xs

                duration-200

                peer-focus:text-xs
                peer-focus:top-0
                peer-focus:text-blue-700
                peer-placeholder-shown:top-4
                peer-placeholder-shown:text-base
                peer-autofill:text-xs
                peer-autofill:top-0
                peer-disabled:opacity-50
                {{ $attributes->get('labelBlock') }}
            "
        >
            {{ $label . ($required ? '*' : '') }}
        </label>
    @endif
</div>
