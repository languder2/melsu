<h4 class="font-semibold mt-4 -mb-2 flex gap-2 justify-between items-center">
    {!! $label !!}

    @if(auth()->check())
        <a
            href="{{ route('info:form:common',['type'=> 'places', 'code' => $prop]) }}"
            onclick="Modal.showModal(this.href); return false;"
            class="inline-block p-2 bg-green-950 rounded hover:bg-green-700 mr-4"
        >
            <x-info.forms.icons.add width="20px" height="20px" />
        </a>
    @endif

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
            <td class="p-4 border-b flex gap-2 justify-between items-center">
                @if(auth()->user())
                    <a
                        href="{{ $item->form }}"
                        onclick="Modal.showModal(this.href); return false;"
                        class="underline hover:text-blue"
                    >
                        {!! $item->content ?? __('info.empty') !!}
                    </a>

                    <a href="{{ $item->delete }}"
                       class="inline-block p-2 bg-red rounded hover:bg-red-700"
                    >
                        <x-info.forms.icons.delete width="20px" height="20px" />
                    </a>
                @else
                    {!! $item->content ?? __('info.empty') !!}
                @endif
            </td>
        </tr>
    @empty
        <tr class="bg-white" itemprop="{{ $prop }}">
            <td class="p-4 border-b">
                {!! __('info.empty') !!}
            </td>
            <td class="p-4 border-b">
                {!! __('info.empty') !!}
            </td>
        </tr>
    @endforelse
</table>
