<x-head.tinymce-config/>

<form
    action="{{route('admin:department:save')}}"
    method="POST"
    enctype="multipart/form-data"
    class="
        p-4 bg-white rounded-md
        max-w-[1200px]
        mx-auto
    "
>
    @csrf

    <h3 class="pb-2 font-semibold text-xl uppercase text-center">
        @if(isset($current->id))
            Внести изменения {{$current->name}}
        @else
            Добавить кафедру
        @endif
    </h3>

    <hr>

    <x-form.errors/>

    <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>


    <x-form.select
        id="form_faculty_code"
        name="faculty_code"
        nullDisabled
        old="{{old('faculty_code')??$add2faculty}}"
        value="{{$current?->faculty_code}}"
        null="Выбрать"
        :list="$faculties"
        label="Факультет"
        onchange="DependedSelects.departmentsByFaculty('form_faculty_code','form_department')"
        required
    />

    <x-form.input
        id="form_name"
        name="name"
        label="Название"
        value="{{old('name')??@$current->name}}"
        required
    />

    <x-form.input
        id="form_alias"
        name="code"
        label="Alias"
        value="{{old('code')??@$current->code}}"
        required
    />

    <x-form.input
        id="form_order"
        name="order"
        type="number"
        label="Порядок вывода"
        value="{{old('order')??@$current->order}}"
    />

    <x-form.editor
        id="form_description"
        name="description"
        label="Описание"
        borderTop
        value="{{old('description')??@$current->description}}"
    />

    <x-form.submit
        class="uppercase"
        value="сохранить"
    />

</form>


