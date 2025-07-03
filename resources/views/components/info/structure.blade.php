@isset($label)
    <h4 class="font-semibold mt-4 -mb-2">
        {!! $label !!}
    </h4>
@endisset
<table>
    <tr class="top-0 sticky {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
        @foreach($captions as $label)
            <td class="p-4 border-r border-r-white last:border-none">
                {!! $label->getName() !!}
            </td>
        @endforeach
    </tr>
    @forelse($list as $item)
        <tr @class([ $loop->index%2 ? 'bg-white/50' : 'bg-white' ]) itemprop="{{ $prop }}">
            @foreach($item as $code => $field)
                <td class="p-4 border-b" itemprop="{{ $code }}">
                    @if(is_string($field))
                        {!! $field !!}
                    @else
                        @forelse($field ?? [] as $record)
                            <p>
                                {!! $record->content ?? __('info.empty') !!}
                            </p>
                        @empty
                            {{ __('info.empty') }}
                        @endforelse
                    @endif
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
