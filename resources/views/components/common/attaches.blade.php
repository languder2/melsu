@props([
    'document' => null
])

@if($document)
    @php
        $file = $document->filename;
        $title = $document->title ?? 'Скачать файл';
        $size = isset($file->size) ? round($file->size / 1024 / 1024, 2) . ' MB' : null;
        $extension = pathinfo($document->filename, PATHINFO_EXTENSION);
    @endphp

    <div class="attachment-block border rounded-lg px-4 py-2 flex items-center justify-between bg-gray-50">
        <div class="grid grid-cols-[6ch_1fr_auto] items-center gap-3">
            <div class="bg-blue-100 p-3 rounded text-blue-600 font-bold uppercase text-xs text-center">
                {{ $extension }}
            </div>

            <div class="flex gap-2">
                @if($document->parent_id)
                    <div class="ps-4">⤷</div>
                @endif
                <p class="font-medium my-0 text-gray-900 leading-tight">{!! $title !!}</p>
                @if($size)
                    <span class="text-sm text-gray-500">{{ $size }}</span>
                @endif
            </div>
        </div>

        <a href="{{ $document->link }}"
           {{--       download--}}
           target="_blank"
           class="bg-white border px-4 py-2 rounded-md shadow-sm text-sm hover:bg-gray-100 transition">
            Открыть
        </a>
    </div>
@endif
