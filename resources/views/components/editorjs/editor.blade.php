@props([
    'heading'           => null,
    'id'                => \Illuminate\Support\Str::random(20),
    'name'              => 'content',
    'initialContent'    => json_encode(['blocks' => []]),
    'set'               => 'full',
    'placeholder'       => 'Контент',
])

<div>

    @if($heading)
        <h4 class="font-semibold text-xl mb-3">{{ $heading }}</h4>
    @endif

    <div class="w-full bg-white p-4 ps-10">

        <input type="hidden" id="{{ $id }}Content" name="{{ $name }}" value="{{ $initialContent }}">

        <div
            class="editorJS ps-6"
            id="{{ $id }}"
            data-for="{{ $id }}Content"
            data-set="{{ $set }}"
            data-placeholder="{{ $placeholder }}"
            data-initial-content="{{ $initialContent }}"
        >
        </div>
    </div>

</div>
