<ol start="{{ $start }}" class="ps-3 list-inside list-{{ $isCheklist ? 'none' : $type }}">
    @foreach($items as $item)
        <li class="py-1 last:pb-0">
                @if($isCheklist)
                    @if($item->meta->checked)
                        <x-lucide-circle-check-big class="w-4 inline-block me-2" />
                    @else
                        <x-lucide-circle class="w-4 inline-block me-2" />
                    @endif
                @endif

                {!! $item->content !!}
            @if( !empty($item->items))
                <x-editorjs.list.list
                    :start=" 1 "
                    :type=" $type "
                    :style=" $style "
                    :isCheklist=" $isCheklist "
                    :items=" $item->items "
                />
            @endif
        </li>
    @endforeach
</ol>
