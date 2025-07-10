@isset($label)
    <h4 class="font-semibold mt-4 -mb-2 flex gap-2 justify-between">
        <span>
            {!! $label !!}
        </span>

        @if(auth()->check())
            <a
                href="{{ route($routeName,[$prop]) }}"
                onclick="Modal.showModal(this.href); return false;"
                class="inline-block p-2 bg-green-950 rounded hover:bg-green-700 mr-4"
            >
                <x-info.forms.icons.add width="20px" height="20px" />
            </a>
        @endif
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
            "sticky text-white content-center top-0",
            auth()->check() ? 'bg-blue' : 'bg-red',
         ])
    >
        @if(auth()->check())
            <td class="p-4 border-r border-r-white last:border-none"></td>
            <td class="p-4 border-r border-r-white last:border-none"></td>
        @endif
        @foreach($captions as $label)
            <td class="p-4 border-r border-r-white last:border-none">
                {!! $label->getName() !!}
            </td>
        @endforeach
    </tr>

    @forelse($list as $item)
        <tr @class([ $loop->index % 2 ? 'bg-white' : 'bg-white/50' ]) itemprop="{{ $prop }}">
            @if(auth()->check())
                <td class="p-4 border-b">
                </td>
                <td class="p-4 border-b">

                </td>
            @endif
            @foreach($item as $code => $field)
                <td class="p-4 border-b" itemprop="{{ $code }}">
                    {!! $field !!}
                </td>
            @endforeach
        </tr>
    @empty
        <tr class="bg-white" itemprop="{{ $prop }}">
            @if(auth()->check())
                <td class="p-4 border-b"></td>
                <td class="p-4 border-b"></td>
            @endif
            @foreach($captions as $label)
                <td class="p-4 border-b" itemprop="{{ $label->name }}">
                    {{ __('info.empty') }}
                </td>
            @endforeach
        </tr>
    @endforelse
</table>
