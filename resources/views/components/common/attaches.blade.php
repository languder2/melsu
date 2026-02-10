@props([
    'document' => null
])

@use('\App\Enums\Documents\FileType')
@use('\Illuminate\Support\Facades\Storage')

@if($document)
    @php
        $file = $document->filename;
        $title = $document->title ?? 'Скачать файл';
        $size = Storage::has($document->filename) ? Storage::size($document->filename) : 0;
        $size = isset($size) ? round($size / 1024 / 1024, 2) . ' MB' : null;
        $extension = pathinfo($document->filename, PATHINFO_EXTENSION);

        $icon = optional(FileType::tryFrom($extension))->icon();

    @endphp

    {{--    {{ $extension }}--}}

    <div class="flex flex-col md:grid md:grid-cols-[1fr_20ch] items-center gap-3 p-3 px-7 bg-white shadow-sm">
        <div class="flex gap-3">
            @if($document->parent_id)
                <div class="w-6 flex items-center">
                    <x-lucide-corner-down-right class="w-6 text-base-red"/>
                </div>
            @endif
            <div class="font-medium my-0 text-gray-900 leading-tight flex flex-col gap-3">
                <div>
                    {!! $document->html('before') !!}
                </div>

                <div class="{{ ($document->length('before') + $document->length('after')) ? "font-semibold text-base-red" : '' }}">
                    {{ $document->title }}
                </div>

                <div>
                    {!! $document->html('after') !!}
                </div>
            </div>
        </div>
        <a href="{{ $document->link }}"
           {{--       download--}}
           target="_blank"
           class="
                hover:text-base-red duration-150 transition-all font-semibold text-center gap-3 items-center group
                grid grid-cols-[3ch_1fr_7ch] select-none
           "
        >
            <div>
                {!! $icon !!}
            </div>

            <div class="text-sm text-gray-500 group-hover:text-base-red duration-150 transition-all">{{ $size }}</div>

            <div>
                Открыть
            </div>
        </a>
    </div>
@endif
