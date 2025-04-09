<div class="group block-input-group @isset($blockClasses) {!! $blockClasses !!} @endisset flex flex-col gap-1">
    @isset($slot)
        <label for="{{ $id ?? null }}">
            {!! $slot !!}
        </label>
    @endisset

    <input
        id="{{ $id ?? null }}"
        type="{{ $type ?? 'text' }}"
        name="{{ $name ?? null }}"
        value="{{ $value ?? null }}"
        @required(isset($required))
        @class([
            "rounded-md",
            'py-2 px-3',
            'outline-0',
            $inputClasses ?? "bg-white"
        ])
        autocomplete="password"
    >
</div>
