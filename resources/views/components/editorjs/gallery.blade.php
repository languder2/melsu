@if($block->data->caption && $block->data->caption != '<br>')
    <h3>
        {!! $block->data->caption !!}
    </h3>
@endif

@if(count($block->data->files)<=3)
    <x-gallery.inline
        :title="$block->data->caption"
        :slides="$block->data->files"
    />
@else
    <x-gallery.slider1
        :title="$block->data->caption"
        :slides="$block->data->files"
    />
@endif

