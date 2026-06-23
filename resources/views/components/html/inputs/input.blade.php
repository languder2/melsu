@props([
    'type'         => 'text',
    'id'           => \Illuminate\Support\Str::random(16),
    'name'         => \Illuminate\Support\Str::random(16),
    'label'        => null,
    'wrapperClass' => null,
    'class'        => null,
    'errorClass'   => null,
])

<div class="{{ $wrapperClass }}">
    @if(!is_null($label))
        <label for="{{ $id }}" class="block text-xs font-semibold text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <input id="{{ $id }}"
           type="{{ $type }}"
           name="{{ $name }}"
           @if($name) wire:model="{{ $name }}" @endif

        {{ $attributes->merge([
            'class' => 'w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none ' . $class
        ]) }}
    >

    @if($name)
        @error($name)
            <span class="text-xs text-red-500 mt-1 block {{ $errorClass }}">
                {{ $message }}
            </span>
        @enderror
    @endif
</div>
