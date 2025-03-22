@use('App\Enums\EducationForm')
@use('App\Enums\EducationBasis')

<div
    class="
                    profile_detail
                    p-6 bg-white
                    border-2 border-base-red
                    border-t-0

                "
>
    @foreach(EducationForm::cases() as $form)
        @php
            $profile = $speciality->profileByForm($form) ?? null;
            if(!$profile) continue;
        @endphp

        <div
            class="
                            flex gap-4 flex-col
                            profiles overflow-hidden
                            profile_{{$form->name}} @if(!$loop->first) max-h-0 @endif
                        "
        >

            @include('public.education.speciality.forms.price')

            @include('public.education.speciality.basis.places')

            @include('public.education.speciality.basis.exams')

            <section class="col-span-2">
                <h2 class="font-bold text-xl my-3 uppercase">
                    Основная информация
                </h2>

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
