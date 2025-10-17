@php
    $rows = collect($block->data->content ?? []);
@endphp

<table class="w-full">
    @if($block->data->withHeadings)
        <thead>
        <tr>
            @foreach($rows->first() as $value)
                <td class="font-semibold text-center bg-news-table-head px-3 py-2 text-white">
                    {!! $value !!}
                </td>
            @endforeach
        </tr>
        </thead>
    @endif

    @foreach($rows as $row)
        @continue(!$loop->index && $block->data->withHeadings)
        <tr>
            @foreach($row as $value)
                <td class="px-3 py-2 @if($loop->parent->index % 2) bg-news-table-row-1 @else bg-news-table-row-2 @endif">
                    {!! $value !!}
                </td>
            @endforeach
        </tr>
    @endforeach
</table>
