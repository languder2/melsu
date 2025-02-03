<div
    id="forms_{{$code}}_tab"
    @class([
            'profiles-tabs',
            'border-2 py-4 px-3 border-baseRed',
            ($current === "forms_{$code}_tab")?"":"hidden",
        ])
>

{{--    <x-form.checkbox--}}
{{--        id="profiles_active_{{$code}}"--}}
{{--        name="profiles_active[{{$code}}]"--}}
{{--        text="Активировать"--}}
{{--        class="peer"--}}
{{--        value="{{old('profiles_active.'.$code)}}"--}}
{{--    />--}}

    <label class="peer">
        <input
            type="checkbox"
            class="peer"
        >
    </label>

    <div
        class="peer-checked:bg-blue-600"
    >
        123
    </div>

</div>
