@props([
    'type'         => 'text',
    'id'           => \Illuminate\Support\Str::random(16),
    'name'         => \Illuminate\Support\Str::random(16),
    'label'        => null,
    'wrapperClass' => null,
    'class'        => null,
    'errorClass'   => null,
])
<div class="{{ $wrapperClass }} flex items-center mt-2">
    <label class="relative inline-flex items-center cursor-pointer select-none gap-2">
        <input type="hidden" name="{{ $name }}" value="0" >
        <input
            type="checkbox"
            wire:model="{{ $name }}"
            {{ $attributes->merge([
                'class' => 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 accent-blue-600 cursor-pointer ' . $class
            ]) }}
            value="1"
        >
        <span class="text-sm font-semibold text-gray-700">
            {{ $label }}
        </span>
    </label>

    @error($name) <span class="text-xs text-red-500 ml-2 block">{{ $message }}</span> @enderror
</div>
