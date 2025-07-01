@isset($label)
    <h4 class="font-semibold mt-4 -mb-2">
        {!! $label !!}
    </h4>
@endisset

<div class="flex flex-col gap-4">
    @forelse($list as $item)
        <div class="bg-white p-4" itemprop="{{ $prop }}">
            {!! $item->content !!}
        </div>
    @empty
        <div class="bg-white p-4" itemprop="{{ $prop }}">
            {{ __('info.empty') }}
        </div>
    @endforelse
</div>


