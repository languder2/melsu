<label
    class="
        group
        cursor-pointer
        flex
        w-8 h-8
        items-center justify-center
        bg-stone-100/90
        rounded-lg
        hover:bg-white
        m-3 mb-0
        {{@$additionalClass}}
    "
>
    <input
        type="checkbox"
        class="hidden"
        @if(isset($onclick))
            onclick="{{$onclick}}"
        @endif
        @checked($checked)
    >

    {{$slot}}
</label>
