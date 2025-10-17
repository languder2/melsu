<x-editorjs.list.list
    :start=" $block->data->meta->start ?? 1 "
    :type=" $block->data->meta->counterType ?? 'disc' "
    :style=" $block->data->style "
    :isCheklist=" $block->data->style === 'checklist'"
    :items=" $block->data->items "
/>
