<div class="flex flex-col gap-2 py-2">

    <div class="@if($block->data->withBackground) p-4 bg-slate-200 @endif flex items-center justify-center">
        <img
            src="{{ $block->data->file->url }}"
            alt="{!! $block->data->caption !!}"
            class="@if($block->data->stretched) w-full @endif"
        />
    </div>
    @if($block->data->caption)
    <caption>
        {!! $block->data->caption !!}
    </caption>
    @endif
</div>
