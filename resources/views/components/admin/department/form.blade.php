<x-head.tinymce-config />

<form
    action="{{route('admin:staff:save')}}"
    method="POST"
    enctype="multipart/form-data"
    class="
        p-4 bg-white rounded-md
        max-w-[1200px]
        mx-auto
    "
>
    @csrf

    <h3 class="pb-2 font-semibold text  -xl uppercase text-center">
        @if(isset($current->id))
            Внести изменения в карточку отдела
        @else
            Добавить карточки отдела
        @endif
    </h3>

    <hr>

    <x-form.errors />

    <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>

    <x-form.input
        id="name"
        name="name"
        label="Название"
        value="{{old('name')??@$current->name}}"
{{--        required--}}
    />

    <x-form.input
        id="alias"
        name="alias"
        label="alias (для использования в ссылке, или не заполнено или уникально)"
        value="{{old('alias')??@$current->alias}}"
    />

    <x-form.select-search />

    <x-admin.department.section
        :i="0"
        :current="(object)[]"
    />

    <x-form.submit
        class="uppercase"
        value="сохранить"
    />

</form>
