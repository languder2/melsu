<div class="flex flex-col gap-3">
    @forelse($list as $item)
        <div class="flex gap-2">
            <div class="flex-1 text-center flex gap-4 items-center">
                <div class="flex-1">
                    <a href="{{ $item->link }}" class="underline hover:text-red-700" itemprop="{{ $code }}" target="_blank">
                        {!! $item->title !!}
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div itemprop="{{ $code }}">
            {{ __('info.empty') }}
        </div>
    @endforelse

</div>
