<?php

use Livewire\Volt\Component;
use App\Models\Education\Profile;
use App\Enums\Info\Education;
use Illuminate\Support\Facades\Cache;

new class extends Component {

    public function with(): array
    {
        $section = Education::eduAccred;

        $list = Cache::rememberForever('eduAccred', fn() => Profile::eduAccred());

        $captions = [
            Education::eduCode,
            Education::eduName,
            Education::eduProf,
            Education::eduLevel,
            Education::eduForm,
            Education::learningTerm,
            Education::eduPred,
            Education::eduPrac
        ];

        return compact('list', 'section', 'captions');
    }
};
?>

<div id="{{ $section->name }}" class="w-full">
    <h4 class="font-semibold my-3">
        {!! $section->getName() !!}
    </h4>

    <table class="w-full text-sm text-left">
        <thead class="text-center sticky top-0 bg-red text-white shadow">
        <tr>
            @foreach($captions as $caption)
                <th class="p-3 align-middle border-b  font-normal font-mono text-white border-white/10 first:rounded-tl-lg last:rounded-tr-lg" title="{!! $caption->getName() !!}">
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
                <td class="p-4 border-b" itemprop="eduCode">{!! $item['spec_code'] !!}</td>
                <td class="p-4 border-b" itemprop="eduName">{!! $item['spec_name'] !!}</td>
                <td class="p-4 border-b" itemprop="eduProf">{!! $item['spec_profile'] !!}</td>
                <td class="p-4 border-b" itemprop="eduLevel">{!! $item['level_alt_name'] !!}</td>
                <td class="p-4 border-b" itemprop="eduForm">{!! $item['form_name'] !!}</td>
                <td class="p-4 border-b" itemprop="learningTerm">{!! $item['duration'] !!}</td>

                <td class="p-4 border-b">
                    <div class="flex flex-col gap-2">
                        @forelse($item['eduPredDocs'] as $document)
                            <a href="{{ $document['link'] }}" target="_blank" itemprop="eduPred"
                               class="text-blue-600 hover:text-red-600 hover:underline whitespace-nowrap"
                            >
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
                            <a href="{{ $document['link'] }}" target="_blank" itemprop="eduPrac"
                               class="text-blue-600 hover:text-red-600 hover:underline whitespace-nowrap"
                            >
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
                <td colspan="11" class="p-8 text-gray-500 border-b">{{ __('info.empty') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
