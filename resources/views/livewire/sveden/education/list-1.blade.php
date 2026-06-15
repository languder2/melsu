<?php

use Livewire\Volt\Component;
use App\Models\Education\Profile;
use App\Enums\Info\Education;
use Illuminate\Support\Facades\Cache;

new class extends Component {

    public function with(): array
    {
        $cachedList = Cache::rememberForever('sveden_education_list_1', function () {
            return Profile::with([
                'speciality',
                'getDocuments',
                'getDocuments.options'
            ])
                ->whereHas('speciality')
                ->public()
                ->get()
                ->map(function ($profile) {
                    return [
                        'spec_code'         => $profile->speciality->spec_code,
                        'spec_name'         => $profile->speciality->name,
                        'spec_profile'      => $profile->speciality->name_profile,
                        'level_alt_name'    => $profile->speciality->level?->getAltName() ?? '',
                        'form_name'         => $profile->form?->getName() ?? '',
                        'duration'          => $profile->formatedDuration(),
                        'eduPredDocs'       => $profile->documentsWithOptionValue('eduPred'),
                        'eduPracDocs'       => $profile->documentsWithOptionValue('eduPrac')
                    ];
                })
                ->all();
        });

        return [
            'list' => $cachedList,
        ];
    }
};
?>

<div>
    <h4 class="font-semibold my-3">
        {!! Education::eduAccred->getName() !!}
    </h4>

    <table class="">
        <tr class="text-center sticky top-0" >
            <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">{!! Education::eduCode->getName() !!}</td>
            <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">{!! Education::eduName->getName() !!}</td>
            <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">{!! Education::eduProf->getName() !!}</td>
            <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">{!! Education::eduLevel->getName() !!}</td>
            <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">{!! Education::eduForm->getName() !!}</td>
            <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">{!! Education::learningTerm->getName() !!}</td>
            <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">{!! Education::eduPred->getName() !!}</td>
            <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">{!! Education::eduPrac->getName() !!}</td>
        </tr>

        @forelse($list as $item)
            <tr @class([ $loop->index % 2 ? 'bg-white' : 'bg-white/50', 'text-center' ]) itemprop="{{ Education::eduAccred->name }}">
                <td class="p-4 border-b" itemprop="eduCode">{!! $item['spec_code'] !!}</td>
                <td class="p-4 border-b" itemprop="eduName">{!! $item['spec_name'] !!}</td>
                <td class="p-4 border-b" itemprop="eduProf">{!! $item['spec_profile'] !!}</td>
                <td class="p-4 border-b" itemprop="eduLevel">{!! $item['level_alt_name'] !!}</td>
                <td class="p-4 border-b" itemprop="eduForm">{!! $item['form_name'] !!}</td>
                <td class="p-4 border-b" itemprop="learningTerm">{!! $item['duration'] !!}</td>

                <td class="p-4 border-b">
                    <div class="flex flex-col gap-2">
                        @forelse($item['eduPredDocs'] as $document)
                            <a href="{{ $document['link'] }}" class="underline hover:text-red text-nowrap" target="_blank" itemprop="eduPred">
                                {!! $document['title'] !!}
                            </a>
                        @empty
                            <div itemprop="eduPred">{{ __('info.empty') }}</div>
                        @endforelse
                    </div>
                </td>

                <td class="p-4 border-b">
                    <div class="flex flex-col gap-2">
                        @forelse($item['eduPracDocs'] as $document)
                            <a href="{{ $document['link'] }}" class="underline hover:text-red text-nowrap" target="_blank" itemprop="eduPrac">
                                {!! $document['title'] !!}
                            </a>
                        @empty
                            <div itemprop="eduPrac">{{ __('info.empty') }}</div>
                        @endforelse
                    </div>
                </td>
            </tr>
        @empty
            <tr class="bg-white text-center">
                <td colspan="8" class="p-4 border-b">{{ __('info.empty') }}</td>
            </tr>
        @endforelse
    </table>
</div>
