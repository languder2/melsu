<div
    id="tab_speciality"
    @class([
        'speciality-tabs',
        'max-w-[1200px] mx-auto',
        str_contains($attributes['class'], 'hidden')?'hidden':'',
    ])
>
    <h3 class="text-lg font-semibold">
        Основные данные
    </h3>

    <x-form.input
        type="hidden"
        name="id"
        value="{{$current?->id}}"
    />

    <x-form.input
        id="form_spec_name"
        name="name"
        label="Название"
        value="{{old('speciality.name')??$current?->name}}"
        required1
    />

    <x-form.input
        id="form_spec_code"
        name="code"
        label="Alias"
        value="{{old('speciality.code')??$current?->code}}"
        required1
    />

    <div class="flex gap-4">
        <div class="flex-1">
            <x-form.input
                id="form_spec_code"
                name="spec_code"
                label="Код специальности"
                value="{{old('speciality.spec_code')??$current?->spec_code}}"
                required
            />
        </div>

        <x-form.on-off
            :old="old('show')"
            :current="$current"
        />
    </div>


    <div class="bg-base-red/20 p-4">
        <x-form.select
            id="form_spec_faculty"
            name="faculty_code"
            nullDisabled
            old="{{old('speciality.faculty_code')??$add2faculty}}"
            value="{{$current?->faculty_code}}"
            null="Выбрать"
            :list="$faculties2 ?? []"
            label="Факультет"
        />

        <x-form.select
            id="form_spec_department"
            name="department_code"
            old="{{old('speciality.department_code')}}"
            value="{{$current?->department_code}}"
            null="Выбрать"
            :list="$departments2 ?? []"
            label="Кафедра"
            required1
        />
    </div>

    <div class="bg-green-700/20 p-4">
        <x-form.select
            id="faculty_id"
            name="faculty_id"
            old="{{ old('faculty_id') }}"
            value="{{ $current->faculty_id }}"
            null="выбрать"
            label="Факультет"
            :list="$faculties ?? []"
        />

        <x-form.select
            id="department_id"
            name="department_id"
            old="{{ old('department_id') }}"
            value="{{ $current->department_id }}"
            null="выбрать"
            label="Кафедра"
            :list="$departments ?? []"
        />
    </div>


    <x-form.select
        id="form_level_code"
        name="level_code"
        nullDisabled
        old="{{old('speciality.level_code')}}"
        value="{{$current?->level_code}}"
        null="Выбрать"
        :list="$levels"
        label="Уровень"
        required1
    />

    <x-form.input
        id="form_speciality_logo"
        type="file"
        name="logo"
        label="Логотип"
        value="{{old('logo')}}"
    />

    <x-form.editor
        id="for_spec_description"
        name="description"
        label="Описание специальности"
        value="{{old('description')??$current?->description}}"
        hideLabel
        height="800px"
    />

</div>
