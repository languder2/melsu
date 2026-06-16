<?php

use Livewire\Volt\Component;
use App\Models\Education\Profile;
use App\Enums\Info\Education;
use Illuminate\Support\Facades\Cache;

new class extends Component {

    public function with(): array
    {
        $section = Education::eduOp;

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

        $list = Cache::rememberForever('eduOp', function () {
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

        return compact('list', 'captions', 'docsOp', 'section');
    }
};
?>

<div id="{{ $section->name }}">
    <h4 class="font-semibold my-3">
        {!! $section->getName() !!}
    </h4>

    <div>
        <table class="w-full text-sm text-left border-collapse">
            <thead class="text-center shadow-sm sticky top-0">
            <tr>
                @foreach($captions as $caption)
                    <th class="p-3 bg-red text-white font-medium align-middle border-b border-white/10 text-balance" title="{!! $caption->getName() !!}">
                        <p class="line-clamp-3">
                            {!! $caption->getName() !!}
                        </p>
                    </th>
                @endforeach
            </tr>
            </thead>

            <tbody>
            @forelse($list as $item)
                <tr @class([ $loop->index % 2 ? 'bg-white' : 'bg-gray-50', 'text-center border-b hover:bg-gray-100 transition-colors' ]) itemprop="{{ $section->name }}">
                    <td class="p-4" itemprop="eduCode">{!! $item['spec_code'] !!}</td>
                    <td class="p-4" itemprop="eduName">{!! $item['spec_name'] !!}</td>
                    <td class="p-4" itemprop="eduProf">{!! $item['spec_profile'] !!}</td>
                    <td class="p-4" itemprop="eduLevel">{!! $item['level_alt_name'] !!}</td>
                    <td class="p-4" itemprop="eduForm">{!! $item['form_name'] !!}</td>

                    @foreach($docsOp as $op)
                        <td class="p-4 align-top text-left border-l border-gray-100">
                            <div class="flex flex-col gap-2 items-center justify-center">
                                @forelse($item[$op] ?? [] as $document)
                                    <a href="{{ $document['link'] }}"
                                       class="text-blue-600 hover:text-red-600 hover:underline whitespace-nowrap"
                                       target="_blank"
                                       itemprop="{{ $op }}"
                                    >
                                        {!! $document['title'] !!}
                                    </a>
                                @empty
                                    <div itemprop="{{ $op }}">{{ __('info.empty') }}</div>
                                @endforelse
                            </div>
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr class="bg-white text-center">
                    <td colspan="11" class="p-8 text-gray-500 border-b">{{ __('info.empty') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
