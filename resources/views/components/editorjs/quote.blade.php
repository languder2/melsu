@php
    $blocks = collect(explode("<br>", $block->data->text ?? ''))->filter(fn ($p) => !empty($p) );
@endphp

@if($blocks->count())
    <blockquote class="
    px-4
    py-2
    border-l-4
    border-gray-400
    text-gray-700
    italic
    text-lg
    leading-relaxed
    bg-white
">

        @foreach($blocks as $p)
            <p class="m-0">
                {!! $p !!}
            </p>
        @endforeach


        @if($block->data->caption)
            <footer class="text-sm text-gray-500 not-italic p-2 text-right">
                {!! $block->data->caption !!}
            </footer>
        @endif
    </blockquote>
@endif
