@use('App\Enums\EducationLevel')
<div
    id="tab_speciality"
    @class([
        "form_box",
        (!old('_token') || old('side_menu') === 'tab_speciality')?'':'hidden'
    ])
>
    <div class="bg-white p-4">
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


        <x-form.select
            id="faculty_id"
            name="faculty_id"
            old="{{ old('faculty_id')}}"
            value="{{ $current->faculty_id ?? null }}"
            null="выбрать"
            label="Факультет"
            :list="$faculties ?? []"
        />

        <x-form.select
            id="department_id"
            name="department_id"
            old="{{ old('department_id')}}"
            value="{{ $current->department_id ?? null }}"
            null="выбрать"
            label="Кафедра"
            :list="$departments ?? []"
        />


        <x-form.select
            id="form_level_code"
            name="level"
            nullDisabled
            old="{{old('speciality.level')}}"
            value="{{$current?->level}}"
            null="Выбрать"
            :list="EducationLevel::getList()"
            label="Уровень"
            required1
        />

        <div class="flex gap-4">
            @if($current->ico)
                <div class="bg-gray-700 py-2 px-3">
                    <img src="{!! $current->ico->image !!}" alt="ico" class="h-10">
                </div>
            @endif

            <div class="flex-1">
                <x-form.file
                    id="form_ico"
                    label="Иконка"
                    name="ico"
                />
            </div>
        </div>
    </div>

    <div
        class="bg-white p-4 mt-4"
    >
        <h4 class="font-semibold text-xl">Описание</h4>
        <x-form.editor
            id="for_spec_description"
            name="description"
            label="Описание специальности"
            value="{{old('description')??$current?->description}}"
            hideLabel
            height="800px"
        />
    </div>

</div>

