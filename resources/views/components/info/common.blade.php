<div class="grid gap-2 grid-cols-[700px_1fr]">
    @foreach($list as $code=>$item)
        <div class="p-4 bg-white flex items-center font-semibold">
            {!! __("info.common.{$code}") !!}
        </div>
        <div class="p-4 bg-white flex items-center gap-2" itemprop="{{ $code }}">
            @if(auth()->user())
                <a
                    href="javascript:Modal.showModal('{{ $item->form }}')"
                    class="underline hover:text-blue"
                >
                    {!! $item->content ?? __('info.empty') !!}

                </a>
            @else
                <div>
                    {!! $item->content ?? __('info.empty') !!}
                </div>
            @endif
        </div>
    @endforeach
</div>
