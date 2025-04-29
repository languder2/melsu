<li class="py-1">
    <a
        href="{{ $document->link }}"
        target="_blank"
        class="hover:ms-2 duration-300 transition-all hover:text-base-red"
    >
        {!! $document->title !!}
    </a>

    @if($document->publicSubs->count())
        <ul class="mt-2">
            @each("documents.public.item",$document->publicSubs,'document')
        </ul>
    @endif
</li>
