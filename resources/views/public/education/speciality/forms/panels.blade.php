@use('App\Enums\EducationForm')
@use('App\Enums\EducationBasis')

<div
    class="
                    profile_detail
                    bg-white
                    border-2 border-base-red
                    border-t-0

                "
>
    @foreach(EducationForm::cases() as $form)
        @unless($profile = $speciality->profileByForm($form,true))
            @continue
        @endunless

        <div
            class="
                flex flex-col
                profiles overflow-hidden
                profile_{{$form->name}} @if(!$loop->first) max-h-0 @endif
            "
        >

            <div class="flex gap-4 flex-col lg:flex-row p-4">
                <div class="flex-1">
                    @include('public.education.speciality.forms.duration')
                </div>
                <div class="flex-1">
                    @include('public.education.speciality.forms.price')
                </div>
            </div>

            <div class="flex gap-4 flex-col lg:flex-row p-4 ">
                @component('public.education.speciality.basis.places',[
                    'profile'   => $profile,
                    'basis'     => EducationBasis::Budget,
                ])
                    Мест на бюджете
                @endcomponent

                @component('public.education.speciality.basis.places',[
                    'profile'   => $profile,
                    'basis'     => EducationBasis::Contract,
                ])
                    Мест на платной основе
                @endcomponent
            </div>


            <section class="border-y-1 border-dashed">
                <h2 class="uppercase font-semibold text-lg text-center p-4">
                    Вступительные испытания и минимальные баллы
                </h2>

                <div class="flex flex-col lg:flex-row gap-4">
                    @if($profile->showByBasis(EducationBasis::Budget))
                        <div class="flex-1 flex flex-col gap-3 p-4">
                            @component('public.education.speciality.basis.exams',[
                                'required'    => $profile->requiredExamsByType(EducationBasis::Budget),
                                'selectable'  => $profile->selectableExamsByType(EducationBasis::Budget),
                                'total'       => $profile->scoreByType(EducationBasis::Budget)
                            ])
                                на бюджете
                            @endcomponent
                        </div>
                    @endif

                    @if($profile->showByBasis(EducationBasis::Contract))
                        <div class="flex-1 flex flex-col gap-3 p-4">
                            @component('public.education.speciality.basis.exams',[
                                'required'    => $profile->requiredExamsByType(EducationBasis::Contract),
                                'selectable'  => $profile->selectableExamsByType(EducationBasis::Contract),
                                'total'       => $profile->scoreByType(EducationBasis::Contract)
                            ])
                                на платное
                            @endcomponent
                        </div>
                   @endif
                </div>
            </section>




            <section class="p-4">
                <div class="flex gap-3 flex-col lg:flex-row bg-white px-4 py-3">
                    @if($profile->address)
                        <div class="flex-1">
                            <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                                основной корпус
                            </h3>
                            <div>
                                {{$profile->address}}
                            </div>
                        </div>
                    @endif


                    @if($speciality->chief)
                        <div class="flex-1">
                            <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                                руководитель
                            </h3>
                            <div>
                                Иванов Иван Иванович
                            </div>
                        </div>
                    @endif

                    <div class="flex-1">
                        <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                            прием иностранных граждан
                        </h3>
                        <div>
                            {{__('statuses.afc_'.$profile->afc)}}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endforeach
</div>
