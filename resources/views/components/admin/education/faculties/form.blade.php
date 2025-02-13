<x-head.tinymce-config/>

<form
    action="{{route('admin:education-faculty:save')}}"
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
            Внести изменения факультет {{$current->name}}
        @else
            Добавить факультет
        @endif
    </h3>

    <hr>

    <x-form.errors/>

    <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>

    <x-form.file
        id="form_photo"
        name="image"
        label="Image"
        value="{{old('image')}}"
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
