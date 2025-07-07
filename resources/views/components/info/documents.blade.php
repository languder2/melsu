<h4 class="font-semibold mt-4 -mb-2 flex gap-2 justify-between items-center">
{!! $label !!}

    @if(auth()->check())
        <a
            href="{{ route('info:document:form',['type'=> $type ?? '', 'code' => $prop]) }}"
            onclick="Modal.showModal(this.href); return false;"
            class="inline-block p-2 bg-green-950 rounded hover:bg-green-700 mr-4"
        >
            <x-info.forms.icons.add width="20px" height="20px" />
        </a>
    @endif

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

