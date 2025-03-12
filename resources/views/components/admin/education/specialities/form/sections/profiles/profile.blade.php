<div
    id="forms_{{$code}}_tab"
    @class([
            'profiles-tabs',
            'border-2 py-4 px-3 border-baseRed',
            ($currentTab === "forms_{$code}_tab")?"":"hidden",
        ])
>
    <input
        id="activator_form_{{$code}}"
        type="checkbox"
        name="profiles[{{$code}}][show]"
        class="peer w-4 h-4"
        @checked(old("speciality.name")?old("profiles.{$code}.show"):@$profile?->show)
    >
    <label for="activator_form_{{$code}}" class="pointer">
        Активировать форму обучения
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
        <input type="hidden" name="profiles[{{$code}}][form_code]" value="{{$code}}">


        <div class="grid grid-cols-2 gap-x-4">
{{--            <x-staff.select--}}
{{--                :current="null"--}}
{{--                :params='[--}}
{{--                "name"      => "profiles[{$code}][director]",--}}
{{--                "label"     => "Директор",--}}
{{--                "id"        => "profiles_{$code}_director",--}}
{{--                "value"     => old("profiles.{$code}.director")??@$profile?->director,--}}
{{--            ]'--}}
{{--            />--}}

            <div class="py-4">
                <input
                    id="form_profiles_{{$code}}_afc"
                    name="profiles[{{$code}}][afc]"
                    type="checkbox"
                    @checked(old("profiles.{$code}.afc") || @$profile?->afc)
                    class="
                        w-4 h-4 text-baseRed bg-gray-100 border-gray-300 rounded
                        focus:ring-baseRed focus:ring-2
                        cursor-pointer
                    "
                >
                <label
                    for="form_profiles_{{$code}}_afc"
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
            id="form_profiles_{{$code}}_address"
            name="profiles[{{$code}}][address]"
            label="Адрес"
            value='{{old("profiles.{$code}.address")??@$profile?->address}}'
        />

        <div class="grid grid-cols-2 gap-x-4 mt-3">
            <x-form.input
                id="form_profiles_{{$code}}_duration"
                name="profiles[{{$code}}][duration]"
                type="number"
                step="0.01"
                label="Срок обучения"
                value='{{old("profiles.{$code}.duration")??@$profile?->duration}}'
            />

            <x-form.input
                id="form_profiles_{{$code}}_price"
                name="profiles[{{$code}}][price]"
                type="number"
                label="Стоимость, р."
                value='{{old("profiles.{$code}.price")??@$profile?->price}}'
            />

            <x-form.input
                id="form_profiles_{{$code}}_places_budget"
                name="profiles[{{$code}}][places][budget]"
                type="number"
                label="Кол-во мест, бюджет"
                :value="old('profiles.'.$code.'.places.budget')??@$profile->places['budget']"
            />

            <x-form.input
                id="form_profiles_{{$code}}_places_contract"
                name="profiles[{{$code}}][places][contract]"
                type="number"
                label="Кол-во мест, контракт"
                :value="old('profiles.'.$code.'.places.contract')??@$profile->places['contract']"
            />

            <div>
                <h3 class="text-lg font-semibold text-center">
                    Экзамены: Бюджет
                </h3>
                <x-exam.admin-list
                    :code="$code"
                    type="budget"
                    :exams="@$profile->exams"
                />
            </div>
            <div>
                <h3 class="text-lg font-semibold text-center">
                    Экзамены: Контракт
                </h3>
                <x-exam.admin-list
                    :code="$code"
                    type="contract"
                    :exams="@$profile->exams"
                />
            </div>
        </div>
    </div>
</div>
