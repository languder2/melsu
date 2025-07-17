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
                <td class="p-4 border-b text-center" itemprop="teachingDiscipline">
                    {!! $item->teachingDiscipline ?? __('info.empty') !!}
                </td>
                <td class="p-4 border-b text-center" itemprop="teachingLevel">
                    {!! $item->teachingLevel ?? __('info.empty') !!}
                </td>
                <td class="p-4 border-b text-center" itemprop="degree">
                    {!! $item->degree ?? __('info.empty') !!}
                </td>
                <td class="p-4 border-b text-center" itemprop="academStat">
                    {!! $item->academStat ?? __('info.empty') !!}
                </td>
                <td class="p-4 border-b text-center" itemprop="qualification">
                    {!! $item->qualification ?? __('info.empty') !!}
                </td>
                <td class="p-4 border-b text-center" itemprop="profDevelopment">
                    {!! $item->profDevelopment ?? __('info.empty') !!}
                </td>
                <td class="p-4 border-b text-center" itemprop="specExperience">
                    {!! $item->specExperience ?? __('info.empty') !!}
                </td>
                <td class="p-4 border-b text-center" itemprop="teachingOp">
                    {!! $item->teachingOp ?? __('info.empty') !!}
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
