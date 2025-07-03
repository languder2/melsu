<h4 class="font-semibold mt-4 -mb-2">
    {!! $label !!}
</h4>

<table>
    <tr class="top-0 sticky {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center ">
        <td class="p-4 border-r border-r-white last:border-none">
            № п/п
        </td>
        <td class="p-4 border-r border-r-white last:border-none">
            {{ __('info.places.label') }}
        </td>
    </tr>
    @forelse($list as $item)
        <tr @class([ $loop->index%2 ? 'bg-white/50' : 'bg-white' ])  itemprop="{{ $prop }}">
            <td class="p-4 border-b">
                {{ $loop->iteration }}
            </td>
            <td class="p-4 border-b">
                {!! $item->content ?? __('info.empty') !!}
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
