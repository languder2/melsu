@isset($label)
    <h4 class="font-semibold mt-4 -mb-2">
        {!! $label !!}
    </h4>
@endisset

<table>

    @isset($caption)
        <tr class="top-0 sticky border-b {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center text-center">
                <td class="p-4" colspan="{!! count($captions) !!}">
                    {!! $caption !!}
                </td>
        </tr>
    @endisset

    <tr @class([
            "sticky text-white content-center",
            isset($caption) ? "top-14" : "top-0",
            auth()->check() ? 'bg-blue' : 'bg-red',
         ])
    >
        @foreach($captions as $label)
            <td class="p-4 border-r border-r-white last:border-none">
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
