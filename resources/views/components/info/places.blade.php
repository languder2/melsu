<h4 class="font-semibold mt-4 -mb-2">
    {!! $label !!}
</h4>

<table>
    <tr class="top-9 sticky">
        <td class="p-4 bg-red text-white content-center">
            № п/п
        </td>
        <td class="p-4 bg-red text-white content-center">
            {{ __('info.places.label') }}
        </td>
    </tr>
    @forelse($list as $item)
        <tr @class([ $loop->index%2 ? 'bg-white/50' : 'bg-white' ])  itemprop="{{ $prop }}">
            <td class="p-4 border-b">
                {{ $loop->iteration }}
            </td>
            <td class="p-4 border-b">
                {!! $item ?? __('info.empty') !!}
            </td>
        </tr>
    @empty
        <tr class="bg-white" itemprop="{{ $prop }}">
            <td class="p-4 border-b">
                1
            </td>
            <td class="p-4 border-b">
                {!! __('info.empty') !!}
            </td>
        </tr>
    @endforelse
</table>
