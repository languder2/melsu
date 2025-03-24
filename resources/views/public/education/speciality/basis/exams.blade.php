<h2 class="font-bold lg:col-span-2 text-neutral-600 text-xl uppercase mb-3 text-center">
    {{$slot}}
</h2>

<div @class([
        "flex gap-4 flex-col",
        $dual?"":"lg:flex-row",
    ])
>

    @if($required->count())
        <div class="flex-1">
            <h3 class="font-semibold col-span-2 text-neutral-600 mb-4">
                Обязательные:
            </h3>

            <div class="grid gap-3 grid-cols-[1fr_auto]">
                @foreach($required as $exam)
                    <div>
                        {!! $exam->subject->name !!}
                    </div>

                    <div class="text-right font-semibold">
                        {!! $exam->score ?? $exam->subject->score!!}
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($selectable->count())
        <div class="flex-1">
            <h3 class="font-semibold text-neutral-600 mb-4">
                На выбор:
            </h3>
            <div class="grid gap-3 grid-cols-[1fr_auto]">
                @foreach($selectable as $exam)
                    <div>
                        {!! $exam->subject->name !!}
                    </div>
                    <div class="text-right font-semibold">
                        {!! $exam->score ?? $exam->subject->score!!}
                    </div>
                @endforeach
            </div>
        </div>
   @endif
</div>

<div class="flex-grow"></div>

@if($total)
    <hr class="my-2">
    <div class="grid gap-3 grid-cols-[1fr_auto] font-semibold">
        <div>
            Минимальное кол-во проходных баллов
        </div>
        <div>
            {{ $total }}
        </div>
    </div>
@endif
