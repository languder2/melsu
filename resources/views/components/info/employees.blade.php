@isset($label)
    <h4 class="font-semibold mt-4 -mb-2">
        {!! $label !!}
    </h4>
@endisset
<table class="min-w-[3000px]">
    <tr @class(["sticky text-center", isset($caption) ? "top-23" : "top-0"]) cellpadding="1" >
        @foreach($captions as $label)

            <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
                {!! $label->getName() !!}
            </td>
        @endforeach
    </tr>

    @forelse($list ?? [] as $item)
        <tr @class([ $loop->index % 2 ? 'bg-white' : 'bg-white/50', 'text-center' ]) itemprop="{{ $prop }}">
            <td class="p-4 border-b text-center" itemprop="fio">
                {{ $item->fio ?? __('info.empty') }}
            </td>
            <td class="p-4 border-b text-center" itemprop="post">
                {!! $item->post ?? __('info.empty') !!}
            </td>
            <td class="p-4 border-b text-center" >
                @component('components.info.employees.show-hide-field',[
                    'id'        => $item->id,
                    'prop'      => 'teachingDiscipline',
                    'value'     => $item->teachingDiscipline,
                ])@endcomponent
            </td>
            <td class="p-4 border-b text-center">
                @component('components.info.employees.show-hide-field',[
                    'id'        => $item->id,
                    'prop'      => 'teachingLevel',
                    'value'     => $item->teachingLevel,
                ])@endcomponent
            </td>
            <td class="p-4 border-b text-center">
                @component('components.info.employees.show-hide-field',[
                    'id'        => $item->id,
                    'prop'      => 'degree',
                    'value'     => $item->degree,
                ])@endcomponent
            </td>
            <td class="p-4 border-b text-center">
                @component('components.info.employees.show-hide-field',[
                    'id'        => $item->id,
                    'prop'      => 'academStat',
                    'value'     => $item->academStat,
                ])@endcomponent
            </td>
            <td class="p-4 border-b text-center">
                @component('components.info.employees.show-hide-field',[
                    'id'        => $item->id,
                    'prop'      => 'qualification',
                    'value'     => $item->qualification,
                ])@endcomponent
            </td>
            <td class="p-4 border-b text-center">
                @component('components.info.employees.show-hide-field',[
                    'id'        => $item->id,
                    'prop'      => 'profDevelopment',
                    'value'     => $item->profDevelopment,
                ])@endcomponent
            </td>
            <td class="p-4 border-b text-center" >
                @component('components.info.employees.show-hide-field',[
                    'id'        => $item->id,
                    'prop'      => 'specExperience',
                    'value'     => $item->specExperience,
                ])@endcomponent
            </td>
            <td class="p-4 border-b text-center">
                @component('components.info.employees.show-hide-field',[
                    'id'        => $item->id,
                    'prop'      => 'teachingOp',
                    'value'     => $item->teachingOp,
                ])@endcomponent
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
