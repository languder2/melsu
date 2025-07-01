@isset($label)
    <h4 class="font-semibold mt-4 -mb-2">
        {!! $label !!}
    </h4>
@endisset

<table>

    <tr @class(["sticky ", isset($caption) ? "top-23" : "top-9"]) cellpadding="1" >
        @foreach($captions as $label)
            <td class="p-4 bg-red text-white content-center">
                {!! $label->getName() !!}
            </td>
        @endforeach
    </tr>

    @forelse($list as $item)
        <tr @class([ $loop->index % 2 ? 'bg-white' : 'bg-white/50' ]) itemprop="vacant">
            <td class="p-4 border-b text-center" itemprop="eduCode">
                {{ $item->speciality->spec_code }}
            </td>
            <td class="p-4 border-b" itemprop="eduName">
                {{ $item->speciality->name }}
            </td>
            <td class="p-4 border-b" itemprop="eduProf">
                {{ $item->speciality->name_profile }}
            </td>
            <td class="p-4 border-b" itemprop="eduLevel">
                {{ $item->speciality->level->getAltName() }}
            </td>
            <td class="p-4 border-b" itemprop="eduForm">
                {{ $item->form->getName()}}
            </td>
            <td class="p-4 border-b" itemprop="eduCourse">
                {{ $item->form->getName()}}
            </td>
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
