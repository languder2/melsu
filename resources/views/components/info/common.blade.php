<div class="grid grid-cols-1 lg:grid-cols-[500px_1fr] gap-2">
    @foreach($list as $code=>$item)
        <div class="p-4 bg-white flex items-center font-semibold">
            {!! __("info.common.{$code}") !!}
        </div>
        <div class="p-4 bg-white flex items-center">
            {{ $item->content ?? __('info.empty') }}
        </div>

    @endforeach
</div>
