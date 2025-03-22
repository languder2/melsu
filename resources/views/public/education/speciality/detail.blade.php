@use('App\Enums\EducationForm')
@use('App\Enums\EducationBasis')

@if($speciality->publicProfiles->count())
    <section>
        <h2 class="font-bold text-3xl mb-2 mt-8">Общая информация о программе</h2>

            <div class="flex flex-col xl:flex-row">
                @foreach(EducationForm::cases() as $form)
                    <label
                        for="profile_{{$form->name}}"
                        @disabled(!$speciality->profileByForm($form,true))
                        class="
                        group

                        bg-white
                        px-6 py-3 cursor-pointer flex-1 font-bold transition duration-150
                        text-lg xl:text-xl
                        has-checked:bg-base-red
                        has-checked:text-white
                        has-checked:border-base-red
                        border-2 border-base-red border-t-0 first:border-b-2

                        xl:border-white xl:border-t-2 xl:border-b-base-red
                        xl:has-checked:bg-white
                        xl:has-checked:text-black
                        xl:has-checked:border-b-white
                        hover:text-base-red

                        has-disabled:bg-neutral-300
                        has-disabled:border-neutral-300
                        has-disabled:border-b-base-red
                        has-disabled:text-white
                        has-disabled:hidden
                        has-disabled:xl:block



                    "
                    >
                        <input
                            id="profile_{{$form->name}}"
                            type="radio"
                            name="form"
                            @checked($loop->first)

                            value="panel_{{$form->name}}"
                            class="hidden"
                            onchange="PublicAction.showBlock('profile_{{$form->name}}','.profiles')"
                            @disabled(!$speciality->profileByForm($form,true))
                        >
                        {!! $form->getName() !!}
                    </label>
                @endforeach
            </div>
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
                        $profile = $speciality->profileByForm($form);
                        if(!$profile) continue;
                    @endphp

                    <div
                        class="
                            flex gap-4 flex-col
                            profiles overflow-hidden
                            profile_{{$form->name}} @if(!$loop->first) max-h-0 @endif
                        "
                    >

                        @include('public.education.speciality.duration-price')

                        <div class="flex gap-4 flex-col xl:flex-row">

                        </div>


                        @if($profile->placesByType(EducationBasis::Budget))
                            <div>
                                <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                                    Мест на бюджете
                                </h3>
                                <p class="text-xl">
                                    {!! $profile->placesByType(EducationBasis::Budget) !!}
                                </p>
                            </div>
                        @endif

                        @if($profile->placesByType(EducationBasis::Contract))
                            <div>
                                <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                                    Мест на платной основе
                                </h3>
                                <p class="text-xl">
                                    {!! $profile->placesByType(EducationBasis::Contract) !!}
                                </p>
                            </div>
                        @endif

                        @include('public.education.speciality.exams')

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
    </section>
@endif

{{--<h2 class="uppercase font-bold text-lg my-4 sm:my-8">--}}
{{--    Дополнительная информация и полезные ссылки--}}
{{--</h2>--}}
{{--<div class="grid grid-cols-[1fr] md:grid-cols-[1fr_1fr] xl:grid-cols-[25%_15%_30%_30%] gap-y-3">--}}
{{--    <div class="mb-3 lg:mb-0">--}}
{{--        <a class="font-[400] text-xl text-[var(--primary-color)]">Подготовительные курсы</a>--}}
{{--    </div>--}}
{{--    <div class="mb-3 lg:mb-0">--}}
{{--        <a class="font-[400] text-xl text-[var(--primary-color)]">Олимпиады</a>--}}
{{--    </div>--}}
{{--    <div class="mb-3 lg:mb-0">--}}
{{--        <a class="font-[400] text-xl text-[var(--primary-color)]">Проходные баллы прошлых лет</a>--}}
{{--    </div>--}}
{{--    <div class="mb-3 lg:mb-0">--}}
{{--        <a class="font-[400] text-xl text-[var(--primary-color)]">Вступительные после колледжа</a>--}}
{{--    </div>--}}
{{--</div>--}}

