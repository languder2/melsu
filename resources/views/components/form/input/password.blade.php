<div class="block relative mt-2">
    <input
        type="password"

        @isset($id)
            id="{{$id}}"
        @endif

        name="{{$name}}"

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
        "

        @required(@$required)

        placeholder=""

        autocomplete="new-password"
    >

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
            "
    >
        {{$label}}@if(isset($required))
            *
        @endif
    </label>
</div>
