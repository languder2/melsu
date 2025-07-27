@isset($label)
    <h4 class="font-semibold mt-4 -mb-2">
        {!! $label !!}
    </h4>
@endisset

<table class="min-w-[3500px]">
    <tr class="text-center sticky top-0" >
        @foreach($captions as $label)
            <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
                {!! $label->getName() !!}
            </td>
        @endforeach
    </tr>

    @forelse($list as $item)
        <tr @class([ $loop->index % 2 ? 'bg-white' : 'bg-white/50', 'text-center' ]) itemprop="{{ $prop }}">
            <td class="p-4 border-b" itemprop="eduCode">
                {!! $item->speciality->spec_code !!}
            </td>
            <td class="p-4 border-b" itemprop="eduName">
                {!! $item->speciality->name !!}
            </td>
            <td class="p-4 border-b" itemprop="eduProf">
                {!! $item->speciality->name_profile !!}
            </td>
            <td class="p-4 border-b" itemprop="eduLevel">
                {!! $item->speciality->level->getAltName() !!}
            </td>
            <td class="p-4 border-b" itemprop="eduForm">
                {!! $item->profile->form->getName() !!}
            </td>

            <td class="p-4 border-b">
                <x-info.education.show-documents
                    :documents="$item->documents"
                    code="opMain"
                />
            </td>
            <td class="p-4 border-b">
                <x-info.education.show-documents
                    :documents="$item->documents"
                    code="educationPlan"
                />
            </td>
            <td class="p-4 border-b">
                <x-info.education.show-documents
                    :documents="$item->documents"
                    code="educationRpd"
                />
            </td>
            <td class="p-4 border-b">
                <x-info.education.show-documents
                    :documents="$item->documents"
                    code="educationShedule"
                />
            </td>
            <td class="p-4 border-b">
                <x-info.education.show-documents
                    :documents="$item->documents"
                    code="eduPr"
                />
            </td>
            <td class="p-4 border-b">
                <x-info.education.show-documents
                    :documents="$item->documents"
                    code="methodology"
                />
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
