@use('App\Enums\EducationBasis')

@if($profile->showByBasis(EducationBasis::Contract) || $profile->showByBasis(EducationBasis::Budget))
    <h2 class="uppercase font-bold text-lg mt-6 mb-2 lg:col-span-2">
        Вступительные испытания и минимальные баллы
    </h2>

    <div class="lg:col-span-2 flex gap-4 flex-col xl:flex-row">
        <div class="flex-1">
            @component('public.education.speciality.scores',[
                'required'    => $profile->requiredExamsByType(EducationBasis::Budget),
                'selectable'  => $profile->selectableExamsByType(EducationBasis::Budget),
                'total'       => $profile->scoreByType(EducationBasis::Budget)
            ])
                на бюджет
            @endcomponent
        </div>

        <div class="flex-1">
            @component('public.education.speciality.scores',[
                'required'    => $profile->requiredExamsByType(EducationBasis::Contract),
                'selectable'  => $profile->selectableExamsByType(EducationBasis::Contract),
                'total'       => $profile->scoreByType(EducationBasis::Contract)
            ])
                на платное
            @endcomponent
        </div>
    </div>
@endif
