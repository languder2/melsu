<h4 class="font-semibold mt-4 -mb-2 flex gap-4 justify-between items-center">
    {!! $label !!}

    @if(auth()->check())
        <a href="{{ route('info:form:founder') }}"
           class="inline-block p-2 bg-green-950 rounded hover:bg-green-700 mr-4"
           onclick="Modal.showModal(this.href); return false;"
        >
            <x-info.forms.icons.add width="20px" height="20px" />
        </a>
    @endif

</h4>

<table>
    <tr class="top-0 sticky {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
        @if(auth()->check())
            <td class="p-4 border-r border-r-white last:border-none">
                del
            </td>
            <td class="p-4 border-r border-r-white last:border-none">
                edit
            </td>
        @endif
        @foreach($captions as $item)
            <td class="p-4 border-r border-r-white last:border-none">
                {!! $item->label() !!}
            </td>
        @endforeach
    </tr>
    @forelse($list as $item)
        <tr @class([ $loop->index%2 ? 'bg-white/50' : 'bg-white' ])  itemprop="{{ $prop }}">

            @if(auth()->check())
                <td class="p-4 border-b text-center">
                    <a href="{{ $item->delete }}"
                       class="inline-block p-2 bg-red rounded hover:bg-red-700"
                    >
                        <x-info.forms.icons.delete width="20px" height="20px" />
                    </a>
                </td>

                <td class="p-4 border-b text-center">
                    <a href="{{ $item->FormFounder }}"
                       class="inline-block p-2 bg-blue rounded hover:bg-blue-700"
                       onclick="Modal.showModal(this.href); return false;"
                    >
                        <x-info.forms.icons.edit width="20px" height="20px" />
                    </a>
                </td>
            @endif

            @foreach($item->fields as $code => $filed)
                <td class="p-4 border-b" itemprop="{{ $code }}">
                    {!! $filed->content ?? __('info.empty') !!}
                </td>
            @endforeach
        </tr>

    @empty
        <tr class="bg-white" itemprop="{{ $prop }}">
            @if(auth()->check())
                <td class="p-4 border-b text-center">
                </td>
                <td class="p-4 border-b text-center">
                </td>
            @endif
            @foreach($captions as $field)
                <td class="p-4 border-b text-center" itemprop="{{ $field->name }}">
                    {!! __('info.empty') !!}
                </td>
            @endforeach
        </tr>
    @endforelse
</table>
