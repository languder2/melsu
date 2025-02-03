<div
    id="tab_speciality"
    class="
        max-w-[1200px] mx-auto
    "
>
    <h3 class="text-lg font-semibold">
        Основные данные
    </h3>

    <x-form.input
        id="form_name"
        name="name"
        label="Название"
        value="{{old('name')??@$current->name}}"
        required
    />

    <x-form.input
        id="form_code"
        name="code"
        label="Alias"
        value="{{old('code')??@$current->code}}"
        required
    />

    <x-form.input
        id="form_spec_code"
        name="spec_code"
        label="Код специальности"
        value="{{old('spec_code')??@$current->spec_code}}"
        required
    />

    <x-form.select
        id="form_faculty_code"
        name="faculty_code"
        nullDisabled
        old="{{old('faculty_code')??$add2faculty}}"
        value="{{@$current->faculty_code}}"
        null="Выбрать"
        :list="$faculties"
        label="Факультет"
        required
    />

    <x-form.select
        id="form_department_code"
        name="department_code"
        nullDisabled
        old="{{old('department_code')}}"
        value="{{@$current->department_code}}"
        null="Выбрать"
        :list="$departments"
        label="Кафедра"
        required
    />

    <x-form.select
        id="form_level_code"
        name="level_code"
        nullDisabled
        old="{{old('level_code')}}"
        value="{{@$current->level_code}}"
        null="Выбрать"
        :list="$levels"
        label="Уровень"
        required
    />

    <x-form.input
        id="form_logo"
        name="logo"
        label="Logo"
        value="{{old('logo')}}"
        required
    />

    <x-form.editor
        id="for_spec_description"
        name="description"
        label="Описание специальности"
        value="{{old('description')??@$current->description}}"
        hideLabel
        height="800px"
    />

</div>


