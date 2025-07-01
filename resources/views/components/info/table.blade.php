@isset($label)
    <h4 class="font-semibold mt-4 -mb-2">
        {!! $label !!}
    </h4>
@endisset

<table>

    @isset($caption)
        <tr class="top-9 sticky border-b">
                <td class="p-4 bg-red text-white content-center text-center" colspan="{!! count($captions) !!}">
                    {!! $caption !!}
                </td>
        </tr>
    @endisset

    <tr @class(["sticky ", isset($caption) ? "top-23" : "top-9"]) cellpadding="1" >
        @foreach($captions as $label)
            <td class="p-4 bg-red text-white content-center">
                {!! $label->getName() !!}
            </td>
        @endforeach
    </tr>

    @forelse($list as $item)
        <tr @class([ $loop->index % 2 ? 'bg-white' : 'bg-white/50' ]) itemprop="{{ $prop }}">
            @foreach($item as $code => $field)
                <td class="p-4 border-b" itemprop="{{ $code }}">
                    {!! $field !!}
                </td>
            @endforeach
        </tr>
    @empty
        <tr class="bg-white" itemprop="{{ $prop }}">
            @foreach($captions as $label)
                <td class="p-4 border-b" itemprop="{{ $label->name }}">
                    {{ __('info.empty') }}
                </td>
            @endforeach
        </tr>
    @endforelse
</table>
