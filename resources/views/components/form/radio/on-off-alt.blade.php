<label class="group peer flex items-center gap-3 cursor-pointer {{ $block??'' }}">
    <input
        @isset($id)
            id="{{ $id }}"
        @endisset
        type="checkbox"
        class="peer size-6 rounded-lg border border-gray-300 accent-blue-700 checked:appearance-auto transition-all duration-1000"
        name="{{ $name ?? 'is_show' }}"
        value="on"
        @checked($checked ?? null)
    >
    <span
        class="overflow-hidden block h-7 group-hover:text-blue font-semibold text-lg"
    >
        <span
            class="block -translate-y-full group-has-checked:translate-y-0 duration-500 pb-2px"
        >
            {{ $show ?? __("forms.is_show") }}
        </span>
        <span class="block -translate-y-full group-has-checked:translate-y-0 duration-500 pb-2px">
            {{ $hide ?? __("forms.is_hide") }}
        </span>
    </span>
</label>
