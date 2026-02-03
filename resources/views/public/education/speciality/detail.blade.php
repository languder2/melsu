@if($speciality->publicProfiles->count())
    <section>
        <h2 class="font-bold text-3xl my-6">Общая информация о программе</h2>

        @if($speciality->publicProfiles->count()>1)
            <div class="flex flex-col xl:flex-row">
                @foreach($speciality->publicProfiles as $profile)
                    <label
                        for="profile_{{$profile->form}}"
                        class="
                        group

                        bg-white
                        px-6 py-3 cursor-pointer flex-1 font-bold transition duration-150
                        text-lg xl:text-xl
                        has-checked:bg-base-red
                        has-checked:text-white
                        has-checked:border-base-red
                        border-2 border-base-red border-b-0 last:border-b-2

                        xl:border-white xl:border-b-2 xl:border-b-base-red
                        xl:has-checked:bg-white
                        xl:has-checked:text-black
                        xl:has-checked:border-b-white
                        hover:text-base-red


                    "
                    >
                        <input
                            id="profile_{{$profile->form}}"
                            type="radio"
                            name="form"
                            @checked($loop->first)

                            value="panel_{{$profile->form}}"
                            class="hidden"
                            onchange="PublicAction.showBlock('profile_{{$profile->id}}','.profiles')"
                        >
                        {!! $profile->form->getName() !!}
                    </label>

                @endforeach
            </div>
        @endif

        <div
            class="
                profile_detail
                p-6 bg-white
                border-2 border-base-red
                @if($speciality->publicProfiles->count() > 1) border-t-0 @endif

            "
        >
            @foreach($speciality->publicProfiles as $profile)
                <div
                    class="
                        profiles overflow-hidden profile_{{$profile->id}} @if(!$loop->first) max-h-0 @endif
                        grid gap-5 grid-cols-1 lg:grid-cols-2
                        text-lg
                    "
                >
                    <div>
                        <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                            Срок обучения
                        </h3>
                        <p class="text-xl">
                            {{(int)$profile->duration}} лет
                        </p>
                    </div>

                    <div>
                        <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                            Стоимость обучения за год
                        </h3>
                        <p class="text-xl">
                            {{ number_format($profile->price, 0, '.', ' ') }} &#8381;
                        </p>
                    </div>


                    @if($profile->placesByType(\App\Enums\EducationBasis::Budget))
                        <div>
                            <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                                Мест на бюджете
                            </h3>
                            <p class="text-xl">
                                {!! $profile->placesByType(\App\Enums\EducationBasis::Budget) !!}
                            </p>
                        </div>
                    @endif

                    @if($profile->placesByType(\App\Enums\EducationBasis::Contract))
                        <div>
                            <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                                Мест на платной основе
                            </h3>
                            <p class="text-xl">
                                {!! $profile->placesByType(\App\Enums\EducationBasis::Contract) !!}
                            </p>
                        </div>
                    @endif

                    @include('public.education.speciality.exams')

                </div>
            @endforeach

            <h2 class="uppercase font-bold text-lg mt-8 mb-2 col-span-2">
                Основная информация
            </h2>

            <div class="col-span-2 flex gap-3 flex-col lg:flex-row">
                <div class="flex-1">
                    <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                        основной корпус
                    </h3>
                    <div>
                        Мелитополь, Проспект Б. Хмельницкого, 18
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                        руководитель
                    </h3>
                    <div>
                        Иванов Иван Иванович
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-neutral-600 uppercase font-bold text-lg mb-2">
                        прием иностранных граждан
                    </h3>
                    <div>
                        Возможен
                    </div>
                </div>
            </div>
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

