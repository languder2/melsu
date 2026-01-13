@props([
    'block' => null
])

@php
    $file = $block->data->file;
    $title = $block->data->title ?? 'Скачать файл';
    $size = isset($file->size) ? round($file->size / 1024 / 1024, 2) . ' MB' : null;
    $extension = $file->extension ?? pathinfo($file->url, PATHINFO_EXTENSION);
@endphp

<div class="attachment-block border rounded-lg px-4 py-2 flex items-center justify-between bg-gray-50">
    <div class="grid grid-cols-[auto_1fr_auto] items-center gap-3">
        <div class="bg-blue-100 p-3 rounded text-blue-600 font-bold uppercase text-xs">
            {{ $extension }}
        </div>

        <div>
            <p class="font-medium my-0 text-gray-900 leading-tight">{!! $title !!}</p>
            @if($size)
                <span class="text-sm text-gray-500">{{ $size }}</span>
            @endif
        </div>
    </div>

    <a href="{{ $file->url }}"
{{--       download--}}
       target="_blank"
       class="bg-white border px-4 py-2 rounded-md shadow-sm text-sm hover:bg-gray-100 transition">
        Открыть
    </a>
</div>
