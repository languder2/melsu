<div class="flex flex-col gap-2">
    @forelse($documents->get($code) ?? [] as $document)
        <a
            href="{{ $document->link }}"
            class="underline hover:text-red"
            target="_blank"
        >
            {!! $document->title !!}
        </a>
    @empty
        <div itemprop="{{ $code }}">
            {{ __('info.empty') }}
        </div>
    @endforelse
</div>
