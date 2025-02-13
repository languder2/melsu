<a
    href="{{@$href??"#"}}"
    class="
        cursor-pointer
        flex
        w-8 h-8
        items-center justify-center
        bg-stone-100/90
        rounded-lg
        hover:bg-white
        hover:{{$hoverColor??"text-green-700"}}
        m-3 mb-0
    "
    @if(isset($onclick))
        onclick="{{$onclick}}"
    @endif
>
    {{$slot}}
</a>
