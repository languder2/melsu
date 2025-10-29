@props([
    'id'                => 'form-' . \Illuminate\Support\Str::random(20),
    'type'              => 'submit',
    'name'              => null,
    'value'             => null,
])

<div class="pt-2 {{ $position ?? 'text-right' }}">
    <input
        type="{{ $type }}"
        id="{{ $id }}"

        name="{{$name}}"

        value="{{ $value }}"

        {{ $attributes->class('bg-blue-900 px-4 py-2 text-white rounded-md hover:bg-blue-700 active:bg-gray-700 cursor-pointer') }}

        {{ $attributes }}
    >

</div>
