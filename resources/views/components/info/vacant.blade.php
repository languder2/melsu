@isset($label)
    <h4 class="font-semibold mt-4 -mb-2">
        {!! $label !!}
    </h4>
@endisset
    <table class="min-w-[2000px]">
        <tr class ="sticky text-center top-0 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            @foreach($captions as $label)
                <td class="p-4 border-r border-r-white last:border-none">
                    {!! $label->getName() !!}
                </td>
            @endforeach
        </tr>

        @forelse($list as $item)

            <tr @class([ $loop->index % 2 ? 'bg-white' : 'bg-white/50', 'text-center' ]) itemprop="vacant">
                <td class="p-4 border-b text-center" itemprop="eduCode">
                    {{ $item->speciality->spec_code }}
                </td>
                <td class="p-4 border-b text-left" itemprop="eduName">
                    {{ $item->speciality->name }}
                </td>
                <td class="p-4 border-b text-left" itemprop="eduProf">
                    {{ $item->speciality->name_profile }}
                </td>
                <td class="p-4 border-b" itemprop="eduLevel">
                    {{ $item->speciality->level->getAltName() }}
                </td>
                <td class="p-4 border-b" itemprop="eduForm">
                    {{ $item->profile->form->getName()}}
                </td>
                <td class="p-4 border-b" itemprop="eduCourse">
                    {{ $item->course->content }}
                </td>
                <td class="p-4 border-b" itemprop="numberBFVacant">
                    {{ (int) $item->numberBFVacant->content }}
                </td>
                <td class="p-4 border-b" itemprop="numberBRVacant">
                    {{ (int) $item->numberBRVacant->content }}
                </td>
                <td class="p-4 border-b" itemprop="numberBMVacant">
                    {{ (int) $item->numberBMVacant->content }}
                </td>
                <td class="p-4 border-b" itemprop="numberPVacant">
                    {{ (int) $item->numberPVacant->content }}
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
