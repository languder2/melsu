@isset($label)
    <h4 class="font-semibold mt-4 -mb-2">
        {!! $label !!}
    </h4>
@endisset

<table class="min-w-[3500px]">
    <tr class="text-center sticky top-[2.15rem]" >
        @foreach($captions as $label)
            <td class="p-4 bg-red text-white content-center">
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

            <td class="p-4 border-b" itemprop="perechenNir">
                {{ __('info.empty') }}
            </td>
            <td class="p-4 border-b" itemprop="napravNir">
                {{ __('info.empty') }}
            </td>
            <td class="p-4 border-b" itemprop="resultNir">
                {{ __('info.empty') }}
            </td>
            <td class="p-4 border-b" itemprop="baseNir">
                {{ __('info.empty') }}
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
