@use('App\Enums\EducationForm')
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
            old("_token") ? old("profiles.{$form->name}.show") : $profile->show
        )
    >
    <label for="activator_form_{{$form->name}}" class="pointer">
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
        <input type="hidden" name="profiles[{{$form->name}}][form_code]" value="{{$form}}">


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
            <x-form.input
                id="form_profiles_{{$form->name}}_duration"
                name="profiles[{{$form->name}}][duration]"
                type="number"
                step="0.01"
                label="Срок обучения"
                value='{{old("profiles.{$form->name}.duration")??@$profile?->duration}}'
            />

            <x-form.input
                id="form_profiles_{{$form->name}}_price"
                name="profiles[{{$form->name}}][price]"
                type="number"
                label="Стоимость, р."
                value='{{old("profiles.{$form->name}.price")??@$profile?->price}}'
            />

            <x-form.input
                id="form_profiles_{{$form->name}}_places_budget"
                name="profiles[{{$form->name}}][places][budget]"
                type="number"
                label="Кол-во мест, бюджет"
                :value="old('profiles.'.$form->name.'.places.budget')??@$profile->places['budget']"
            />

            <x-form.input
                id="form_profiles_{{$form->name}}_places_contract"
                name="profiles[{{$form->name}}][places][contract]"
                type="number"
                label="Кол-во мест, контракт"
                :value="old('profiles.'.$form->name.'.places.contract')??@$profile->places['contract']"
            />

            <div>
                <h3 class="text-lg font-semibold text-center">
                    Экзамены: Бюджет
                </h3>
                <x-exam.admin-list
                    :code="$form->name"
                    type="budget"
                    :exams="@$profile->exams"
                />
            </div>
            <div>
                <h3 class="text-lg font-semibold text-center">
                    Экзамены: Контракт
                </h3>
                <x-exam.admin-list
                    :code="$form->name"
                    type="contract"
                    :exams="@$profile->exams"
                />
            </div>
        </div>
    </div>
</div>

