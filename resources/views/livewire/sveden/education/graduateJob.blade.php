<?php

use Livewire\Volt\Component;
use App\Models\Education\Speciality;
use App\Enums\Info\Education;
use Illuminate\Support\Facades\Cache;

new class extends Component {

    public function with(): array
    {
        $section = Education::graduateJob;

        $captions =  [
            Education::eduCode,
            Education::eduName,
            Education::eduProf,

            Education::v1,
            Education::t1,
        ];
        $list = Cache::rememberForever('graduateJob', fn() => Speciality::graduateJob());

        return compact('list', 'captions', 'section');
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
            <tr @class([ $loop->index % 2 ? 'bg-white' : 'bg-white/50', 'text-center' ]) itemprop="{{ $section->name }}">

                <td class="p-4 border-b" itemprop="eduCode">{!! $item['spec_code'] !!}</td>

                <td class="p-4 border-b" itemprop="eduName">{!! $item['spec_name'] !!}</td>

                <td class="p-4 border-b" itemprop="eduProf">{!! $item['spec_profile'] !!}</td>

                <td class="p-4 border-b" itemprop="v1">{!! $item['v1'] !!}</td>

                <td class="p-4 border-b" itemprop="t1">{!! $item['t1'] !!}</td>

            </tr>
        @empty
            <tr class="bg-white text-center">
                <td colspan="11" class="p-8 text-gray-500 border-b">{{ __('info.empty') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
