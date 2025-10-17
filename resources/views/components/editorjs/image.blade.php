<div class="flex flex-col gap-2 py-2">

    <div class="@if($data->withBackground) p-4 bg-slate-200 @endif flex items-center justify-center">
        <img
            src="{{ $data->file->url }}"
            alt="{!! $data->caption !!}"
            class="@if($data->stretched) w-full @endif"
        />
    </div>
    @if($data->caption)
    <caption>
        {!! $data->caption !!}
    </caption>
    @endif
</div>
