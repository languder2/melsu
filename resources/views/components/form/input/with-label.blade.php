<div
    @class([
        "block relative mt-2",
        $boxClasses ?? null
    ])
>
    <input
        type="{{ $type ?? 'text' }}"

        @isset($id)
            id="{{$id}}"
        @endif

        @isset($name)
            name="{{$name}}"
        @endif

        value="{{ old('_token') ? old($old) : $value ?? null }}"

        @class([
            "
                border-b border-dashed outline-0 bg-none
                w-full py-2 mt-2

                peer autofill:text-pink-800 focus:text-blue-700 focus:border-blue-700
            ",
            $inputClasses ?? null,
        ])

        @required($required ?? null)

        placeholder=""
    >

    @if(isset($label) && isset($id))
        <label
            for="{{$id}}"
            @class([
                "
                    absolute left-0 top-0
                    transition-all duration-200
                    text-xs select-none cursor-text

                    peer-focus:text-xs peer-focus:top-0 peer-focus:text-blue-700
                    peer-placeholder-shown:top-4 peer-placeholder-shown:text-base peer-autofill:text-xs
                    peer-autofill:top-0
                ",
                $labelClasses ?? null
            ])
        >
            {!! $ico ?? null !!}
            {{$label.(isset($required)?'*':'')}}
        </label>
    @endif
</div>
