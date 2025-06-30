@isset($label)
    <h4 class="font-semibold mt-4 -mb-2">
        {!! $label !!}
    </h4>
@endisset
<table>
    <tr class="top-9 sticky">
        @foreach($captions as $label)
            <td class="p-4 bg-red text-white content-center">
                {!! $label->getName() !!}
            </td>
        @endforeach
    </tr>


    @if(isset($chief))
        @if($chief)
            <tr class="bg-white" itemprop="{{ $chief_prop }}">
                @foreach($chief as $code => $field)
                    <td class="p-4 border-b" itemprop="{{ $code }}">
                        {!! $field !!}
                    </td>
                @endforeach
            </tr>
        @else
            <tr class="bg-white" itemprop="{{ $chief_prop }}">
                @foreach($captions as $label)
                    <td class="p-4 border-b" itemprop="{{ $label->name }}">
                        {{ __('info.empty') }}
                    </td>
                @endforeach
            </tr>
        @endif
    @endif

    @forelse($staffs as $item)
        <tr @class([ $loop->index%2 ? 'bg-white' : 'bg-white/50' ]) itemprop="{{ $staff_prop }}">
            @foreach($item as $code => $field)
                <td class="p-4 border-b" itemprop="{{ $code }}">
                    {!! $field !!}
                </td>
            @endforeach
        </tr>
    @empty
        <tr class="bg-white" itemprop="{{ $staff_prop }}">
            @foreach($captions as $label)
                <td class="p-4 border-b" itemprop="{{ $label->name }}">
                    {{ __('info.empty') }}
                </td>
            @endforeach
        </tr>
    @endforelse
</table>
