@props([
    'size'      => null,
    'link'      => null,
    'extension' => null
])

@use('\App\Enums\Documents\FileType')

@php
    $size = isset($size) ? round($size / 1024 / 1024, 2) . ' MB' : null;
    $icon = FileType::tryFrom($extension)?->icon();
@endphp

    <a href="{{ $link }}"
       download
       target="_blank"
       class="
                hover:text-base-red duration-150 transition-all font-semibold text-center gap-3 items-center group
                grid grid-cols-[1fr_3ch_10ch_7ch] select-none
                items-center gap-3 p-3 px-7 bg-white shadow-sm
            "
    >
        <div class="text-left">
            {{ $slot }}
        </div>
        <div>
            {!! $icon !!}
        </div>

        <div class="text-sm text-gray-500 group-hover:text-base-red duration-150 transition-all">{{ $size }}</div>

        <div>
            Скачать
        </div>
    </a>
