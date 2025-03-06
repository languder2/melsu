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
        name="speciality[id]"
        value="{{$current?->id}}"
    />

    <x-form.input
        id="form_spec_name"
        name="speciality[name]"
        label="Название"
        value="{{old('speciality.name')??$current?->name}}"
        required1
    />

    <x-form.input
        id="form_spec_code"
        name="speciality[code]"
        label="Alias"
        value="{{old('speciality.code')??$current?->code}}"
        required1
    />

    <x-form.input
        id="form_spec_code"
        name="speciality[spec_code]"
        label="Код специальности"
        value="{{old('speciality.spec_code')??$current?->spec_code}}"
        required1
    />

    <x-form.select
        id="form_spec_faculty"
        name="speciality[faculty_code]"
        nullDisabled
        old="{{old('speciality.faculty_code')??$add2faculty}}"
        value="{{$current?->faculty_code}}"
        null="Выбрать"
        :list="$faculties"
        label="Факультет"
        onchange="DependedSelects.departmentsByFaculty('form_spec_faculty','form_spec_department')"
    />

    <x-form.select
        id="form_spec_department"
        name="speciality[department_code]"
        old="{{old('speciality.department_code')}}"
        value="{{$current?->department_code}}"
        null="Выбрать"
        :list="$departments"
        label="Кафедра"
        required1
    />

    <x-form.select
        id="form_level_code"
        name="speciality[level_code]"
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
        name="speciality[logo]"
        label="Логотип"
        value="{{old('logo')}}"
    />

    <x-form.editor
        id="for_spec_description"
        name="speciality[description]"
        label="Описание специальности"
        value="{{old('description')??$current?->description}}"
        hideLabel
        height="800px"
    />

</div>
