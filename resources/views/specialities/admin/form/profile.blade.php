@use('App\Enums\EducationForm')
@use('App\Enums\EducationBasis')
<div
    id="forms_{{$form->name}}_tab"
    class="
        profiles-tabs border-2 py-4 px-3 border-baseRed bg-white mt-1px

        @if(
            old('_token') && old('profile_tab') !== "forms_{$form->name}_tab"
            || !old('_token') && $form !== EducationForm::Full
        )
            hidden
        @endif
    "

>
    <input
        id="activator_form_{{$form->name}}"
        type="checkbox"
        name="profiles[{{$form->name}}][show]"
        class="peer w-4 h-4"
        @checked(
            old("_token") ? old("profiles.{$form->name}.show") : $profile->show ?? null
        )
    >
    <label for="activator_form_{{$form->name}}" class="pointer">
        Активировать профиль обучения
    </label>
    <div

        class="
            pointer-events-none
            peer-checked:pointer-events-auto
            relative
            before:absolute
            before:z-50
            before:bg-[#883333]
            before:opacity-20
            before:-left-3
            before:-right-3
            before:-bottom-4
            before:top-0
            peer-checked:before:hidden
        "
    >
        <input type="hidden" name="profiles[{{$form->name}}][form]" value="{{$form}}">


        <div class="grid grid-cols-2 gap-x-4">
            {{--            <x-staff.select--}}
            {{--                :current="null"--}}
            {{--                :params='[--}}
            {{--                "name"      => "profiles[{$form->name}][director]",--}}
            {{--                "label"     => "Директор",--}}
            {{--                "id"        => "profiles_{$form->name}_director",--}}
            {{--                "value"     => old("profiles.{$form->name}.director")??@$profile?->director,--}}
            {{--            ]'--}}
            {{--            />--}}

            <div class="py-4">
                <input
                    id="form_profiles_{{$form->name}}_afc"
                    name="profiles[{{$form->name}}][afc]"
                    type="checkbox"
                    @checked(old("profiles.{$form->name}.afc") || @$profile?->afc)
                    class="
                        w-4 h-4 text-baseRed bg-gray-100 border-gray-300 rounded
                        focus:ring-baseRed focus:ring-2
                        cursor-pointer
                    "
                >
                <label
                    for="form_profiles_{{$form->name}}_afc"
                    @class([
                        'ms-2 text-sm font-medium text-gray-900',
                        'cursor-pointer',
                    ])
                >
                    Прием иностранных абитуриентов
                </label>
            </div>
        </div>

        <x-form.input
            id="form_profiles_{{$form->name}}_address"
            name="profiles[{{$form->name}}][address]"
            label="Адрес"
            value='{{old("profiles.{$form->name}.address")??@$profile?->address}}'
        />

        <div class="grid grid-cols-2 gap-x-4 mt-3">

            <div class="grid gap-4 grid-cols-3 items-end">
                <span class="pb-2"> Срок обучения ООО </span>
                <x-form.input
                    id="form_profiles_{{$form->name}}_duration_years"
                    name="profiles[{{$form->name}}][duration][OOO][years]"
                    type="number"
                    class="text-center"
                    step="1"
                    label="Срок обучения, лет"
                    value="0"
                    value='{{old("_token") ? old("profiles.{$form->name}.duration.OOO.years") : $profile->years("OOO")}}'
                />
                <x-form.input
                    id="form_profiles_{{$form->name}}_duration_month"
                    name="profiles[{{$form->name}}][duration][OOO][months]"
                    type="number"
                    class="text-center"
                    step="1"
                    label="Срок обучения, месяцев"
                    value='{{old("_token") ? old("profiles.{$form->name}.duration.OOO.months") : $profile->months("OOO")}}'
                />

                <span class="pb-2"> Срок обучения СОО </span>
                <x-form.input
                    id="form_profiles_{{$form->name}}_duration_years"
                    name="profiles[{{$form->name}}][duration][SOO][years]"
                    type="number"
                    class="text-center"
                    step="1"
                    label="Срок обучения, лет"
                    value="0"
                    value='{{old("_token") ? old("profiles.{$form->name}.duration.SOO.years") : $profile->years("SOO")}}'
                />
                <x-form.input
                    id="form_profiles_{{$form->name}}_duration_month"
                    name="profiles[{{$form->name}}][duration][SOO][months]"
                    type="number"
                    class="text-center"
                    step="1"
                    label="Срок обучения, месяцев"
                    value='{{old("_token") ? old("profiles.{$form->name}.duration.SOO.months") : $profile->months("SOO")}}'
                />
            </div>

            <x-form.input
                id="form_profiles_{{$form->name}}_price"
                name="profiles[{{$form->name}}][price]"
                type="number"
                label="Стоимость, р."
                value='{{old("profiles.{$form->name}.price")??@$profile?->price}}'
            />

            @foreach(EducationBasis::cases() as $basis)
                <div class="p-3 border my-2">

                    <h4 class="font-semibold mb-2 text-center">
                        {{$basis->getName()}}
                    </h4>

                    <x-form.input
                        id="form_profiles_{{$form->name}}_places_{{$basis}}"
                        name="profiles[{{$form->name}}][places][{{$basis->value}}]"
                        type="number"
                        label="Кол-во мест"
                        :value='old("profiles.{$form->name}.places.{$basis->value}") ?? $profile->placesByType($basis) ?? null'
                    />
                    <x-form.input
                        id="form_profiles_{{$form->name}}_places_{{$basis}}"
                        name="profiles[{{$form->name}}][places][{{ $basis->value == 'budget' ? 'budgetooo' : 'contractooo' }}]"
                        type="number"
                        label="Кол-во мест ООО"
                        :value='($basis->value == "budget" ? $profile->placesByType("budgetooo") : ($basis->value == "contract" ? $profile->placesByType("contractooo") : null))'
                    />

                    <x-form.input
                        id="form_profiles_{{$form->name}}_score_{{$basis}}"
                        type="number"
                        max="300"
                        name="profiles[{{$form->name}}][score][{{$basis->value}}]"
                        label="Проходной бал"
                        :value='old("profiles.{$form->name}.score.{$basis->value}") ?? $profile->scoreByType($basis) ?? null'
                    />

                    <h4 class="font-semibold mb-2 mt-4 border-b border-dashed">
                        Экзамены:
                    </h4>

                    <x-exam.admin-list
                        :code="$form->name"
                        :type="$basis->value"
                        :exams="$profile->exams"
                    />

                </div>
            @endforeach

        </div>
    </div>
</div>

