<div
    class="
        flex gap-3 items-center
        @isset($color)
            {{$color}}
        @else
            stroke-base-red
        @endisset
    "
>
    <span>
    {!! $contact->type->getIco() !!}
    </span>
    {!! $contact->content !!}
</div>
