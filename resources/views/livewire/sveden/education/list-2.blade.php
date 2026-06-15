<?php

use Livewire\Volt\Component;
use App\Models\Education\Profile;
use App\Enums\Info\Education;
use Illuminate\Support\Facades\Cache;

new class extends Component {

    public function with(): array
    {
        $captions =  [
            Education::eduCode,
            Education::eduName,
            Education::eduProf,
            Education::eduLevel,
            Education::eduForm,
            Education::opMain,
            Education::educationPlan,
            Education::educationRpd,
            Education::educationShedule,
            Education::eduPr,
            Education::methodology,
        ];

        $docsOp = ['opMain', 'educationPlan', 'educationRpd', 'educationShedule', 'eduPr', 'methodology'];

        $list = Cache::rememberForever('sveden_education_list_2', function () {
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
                        'spec_code'             => $profile->speciality->spec_code,
                        'spec_name'             => $profile->speciality->name,
                        'spec_profile'          => $profile->speciality->name_profile,
                        'level_alt_name'        => $profile->speciality->level?->getAltName() ?? '',
                        'form_name'             => $profile->form?->getName() ?? '',
                        'duration'              => $profile->formatedDuration(),
                        'opMain'                => $profile->documentsWithOptionValue('opMain'),
                        'educationPlan'         => $profile->documentsWithOptionValue('educationPlan'),
                        'educationRpd'          => $profile->documentsWithOptionValue('educationRpd'),
                        'educationShedule'      => $profile->documentsWithOptionValue('educationShedule'),
                        'eduPr'                 => $profile->documentsWithOptionValue('eduPr'),
                        'methodology'           => $profile->documentsWithOptionValue('methodology'),
                    ];
                })
                ->all();
        });

        return compact('list', 'captions', 'docsOp');
    }
};
?>

<div>
    <h4 class="font-semibold my-3">
        {!! Education::eduOp->getName() !!}
    </h4>

    <table class="">
        <tr class="text-center sticky top-0" >
            @foreach($captions as $caption)
                <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">{!! $caption->getName() !!}</td>
            @endforeach
        </tr>

        @forelse($list as $item)
            <tr @class([ $loop->index % 2 ? 'bg-white' : 'bg-white/50', 'text-center' ]) itemprop="{{ Education::eduOp->name }}">
                <td class="p-4 border-b" itemprop="eduCode">{!! $item['spec_code'] !!}</td>
                <td class="p-4 border-b" itemprop="eduName">{!! $item['spec_name'] !!}</td>
                <td class="p-4 border-b" itemprop="eduProf">{!! $item['spec_profile'] !!}</td>
                <td class="p-4 border-b" itemprop="eduLevel">{!! $item['level_alt_name'] !!}</td>
                <td class="p-4 border-b" itemprop="eduForm">{!! $item['form_name'] !!}</td>

                @foreach($docsOp as $op)
                    <td class="p-4 border-b">
                        <div class="flex flex-col gap-2">
                            @forelse($item[$op] ?? [] as $document)
                                <a href="{{ $document['link'] }}"
                                   class="underline hover:text-red text-nowrap"
                                   target="_blank"
                                   itemprop="{{ $op }}"
                                >
                                    {!! $document['title'] !!}
                                </a>
                            @empty
                                <div itemprop="eduPred">{{ __('info.empty') }}</div>
                            @endforelse
                        </div>
                    </td>
                @endforeach
            </tr>
        @empty
            <tr class="bg-white text-center">
                <td colspan="8" class="p-4 border-b">{{ __('info.empty') }}</td>
            </tr>
        @endforelse
    </table>
</div>
