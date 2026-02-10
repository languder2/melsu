@props([
    'id'            => 'form-' . \Illuminate\Support\Str::random(20),
    'name'          => null,
    'value'         => null,
    'label'         => null,
    'class'         => null,
    'block'         => null,
    'placeholder'   => null,
    'multiple',
    'required'      => false,
    'disabled'      => false,
])

<div class="block relative mt-2 {{ $block ?? "" }}">
    <input
        type="file"
        @if(isset($id))
            id="{{$id}}"
        @endif
        name="{{$name}}"
        value="{{@$value}}"
        class="
            border-b
            border-dashed
            bg-none

            outline-0
            w-full
            py-2
            mt-2

            peer
            autofill:text-pink-800
            focus:text-blue-700
            focus:border-blue-700
            disabled:opacity-50

            {{ $class }}
        "
        @isset($multiple)
            multiple
        @endisset

        @required($required)

        @disabled($disabled)

        placeholder="{{ $placeholder }}"
    >

    @if(isset($label) && isset($id))
        <label
            for="{{$id}}"
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
            "
        >
            {{ $label . ( $required ? '*' : '' ) }}
        </label>
    @endif
</div>
