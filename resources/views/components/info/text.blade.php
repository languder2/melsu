@isset($label)
    <h4 class="font-semibold mt-4 -mb-2">
        {!! $label !!}
    </h4>
@endisset

<div class="flex flex-col gap-4">
    @forelse($list as $item)
        <div class="bg-white p-4" itemprop="{{ $prop }}">
            @if(auth()->check())
                <a
                    href="{{ route($route,[$type,$prop,$item->id]) }}"
                    onclick="Modal.showModal(this.href); return false;" class="underline hover:text-blue"
                >
                    {!! $item->content !!}
                </a>
            @else
                {!! $item->content !!}
            @endif
        </div>
    @empty
        <div class="bg-white p-4" itemprop="{{ $prop }}">
            @if(auth()->check())
                <a
                    href="{{ route($route,[$type,$prop]) }}"
                    onclick="Modal.showModal(this.href); return false;" class="underline hover:text-blue"
                >
                    {{ __('info.empty') }}
                </a>
            @else
                {{ __('info.empty') }}
            @endif
        </div>
    @endforelse
</div>
