@isset($label)
    <h4 class="font-semibold mt-4 -mb-2">
        {!! $label !!}
    </h4>
@endisset

<table class="min-w-[3500px]">
    <tr class="text-center sticky top-0" >
        @if(auth()->check())
            <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            </td>
        @endif
        @foreach($captions as $label)
            <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
                {!! $label->getName() !!}
            </td>
        @endforeach
    </tr>

    @forelse($list as $item)
        <tr @class([ $loop->index % 2 ? 'bg-white' : 'bg-white/50', 'text-center' ]) itemprop="{{ $prop }}">
            @if(auth()->check())
                <td class="p-4 border-b" itemprop="eduCode">
                    <a
                        href="{{ route('education-profile.job.modal',$item->id) }}"
                        onclick="Modal.showModal(this.href); return false;"
                        class="inline-block p-2 bg-blue rounded hover:bg-blue-700"
                    >
                        <x-info.forms.icons.edit width="20px" height="20px" />
                    </a>
                </td>
            @endif
            <td class="p-4 border-b" itemprop="eduCode">
                {!! $item->spec_code !!}
            </td>
            <td class="p-4 border-b" itemprop="eduName">
                {!! $item->name !!}
            </td>
            <td class="p-4 border-b" itemprop="eduProf">
                {!! $item->name_profile !!}
            </td>

            <td class="p-4 border-b" itemprop="v1">
                {{ $item->v1 }}
            </td>
            <td class="p-4 border-b" itemprop="t1">
                {{ $item->t1 }}
            </td>
        </tr>
    @empty
        <tr class="bg-white text-center" itemprop="{{ $prop }}">
            @foreach($captions as $label)
                <td class="p-4 border-b" itemprop="{{ $label->name }}">
                    {{ __('info.empty') }}
                </td>
            @endforeach
        </tr>
    @endforelse
</table>
