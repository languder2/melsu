<h4 class="font-semibold mt-4 -mb-2">
    {!! $label !!}
</h4>

<table>
    <tr class="top-9 sticky">
        @foreach($captions as $label)
            <td class="p-4 bg-red text-white content-center">
                {!! $label !!}
            </td>
        @endforeach
    </tr>
    @foreach($list as $item)
        <tr @class([ $loop->index%2 ? 'bg-white/50' : 'bg-white' ])  itemprop="{{ $prop }}">
            @foreach($item->fields as $filed)
                <td class="p-4 border-b" itemprop="{{ $filed->prop }}">
                    {!! $filed->content !!}
                </td>
            @endforeach
        </tr>
    @endforeach
</table>
