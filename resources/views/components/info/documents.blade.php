<h4 class="font-semibold mt-4 -mb-2">
    {!! $label !!}
</h4>

<div class="bg-white px-4 py-2 flex flex-col gap-4">

    @isset($documents)
        @forelse($documents as $item)
            <p>
                <a
                    href="{{ $item->link }}"
                    target="_blank"
                    class="underline hover:text-red"
                    itemprop="{{ $prop }}"
                >
                    {!! $item->title !!}
                </a>
            </p>
        @empty
            <p itemprop="{{ $prop }}">
                {{ __("info.empty") }}
            </p>
        @endforelse
    @endisset

    @isset($list)
        @forelse($list as $item)
            @foreach($item->documents as $document)
                <p>
                    <a
                        href="{{ $document->link }}"
                        target="_blank"
                        class="underline hover:text-red"
                        itemprop="{{ $prop }}"
                    >
                        {!! $item->content !!}
                    </a>
                </p>
            @endforeach
        @empty

            <p itemprop="{{ $prop }}">
                {{ __("info.empty") }}
            </p>
        @endforelse
    @endisset

</div>

