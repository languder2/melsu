<p
    @class([
        isset($block->data->alignment) ? __('editorjs.style.alignment.' . $block->data->alignment) : '',
        isset($block->tunes->backgroundTune) ? __('editorjs.style.bg-' . $block->tunes->backgroundTune->color ) . '' : '',
    ])
>
    {!! $block->data->text !!}

</p>
