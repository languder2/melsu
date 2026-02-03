@use('App\Enums\EducationBasis')
<h2 class="uppercase font-bold text-lg mt-6 mb-2 lg:col-span-2">
    Вступительные испытания и минимальные баллы
</h2>

<div>
    <h2 class="font-bold lg:col-span-2 text-neutral-600 text-xl uppercase mb-3 text-center">
        на бюджет
    </h2>
    <div class="grid gap-3 grid-cols-[1fr_auto]">
        @if($profile->requiredExamsByType(EducationBasis::Budget)->count())
            <h3 class="font-semibold col-span-2 text-neutral-600">
                Обязательные:
            </h3>

            @foreach($profile->requiredExamsByType(EducationBasis::Budget) as $exam)
                <div>
                    {!! $exam->subject->name !!}
                </div>

                <div class="text-right">
                    {!! $exam->score !!}
                </div>
            @endforeach
        @endif

        @if($profile->selectableExamsByType(EducationBasis::Budget)->count())
            <h3 class="font-semibold col-span-2 text-neutral-600 mt-3 last:mt-0">
                На выбор:
            </h3>

            @foreach($profile->selectableExamsByType(EducationBasis::Budget) as $exam)
                <div>
                    {!! $exam->subject->name !!}
                </div>

                <div class="text-right">
                    {!! $exam->score ?? $exam->subject->score!!}
                </div>
            @endforeach
        @endif
    </div>
</div>
<div>
    <h2 class="font-bold lg:col-span-2 text-neutral-600 text-xl uppercase mb-3 text-center">
        на платное
    </h2>
    <div class="grid gap-3 grid-cols-[1fr_auto]">
        @if($profile->requiredExamsByType(EducationBasis::Contract)->count())
            <h3 class="font-semibold col-span-2 text-neutral-600">
                Обязательные:
            </h3>

            @foreach($profile->requiredExamsByType(EducationBasis::Contract) as $exam)
                <div>
                    {!! $exam->subject->name !!}
                </div>

                <div class="text-right">
                    {!! $exam->score !!}
                </div>
            @endforeach
        @endif

        @if($profile->selectableExamsByType(EducationBasis::Contract)->count())
            <h3 class="font-semibold col-span-2 text-neutral-600 mt-3 last:mt-0">
                На выбор:
            </h3>

            @foreach($profile->selectableExamsByType(EducationBasis::Contract) as $exam)
                <div>
                    {!! $exam->subject->name !!}
                </div>

                <div class="text-right">
                    {!! $exam->score ?? $exam->subject->score!!}
                </div>
            @endforeach
        @endif
    </div>

</div>
