<x-head.tinymce-config/>
<form
    action="{{route('admin:events:save')}}"
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
            Внести изменения
        @else
            Добавить новость
        @endif
    </h3>

    <hr>

    <x-form.errors/>

    <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>

    <x-form.select
        id="type"
        name="type"
        nullDisabled
        old="{{old('type')}}"
        value="{{@$current->type}}"
        null="Выберите тип"
        :list="[
            'preview'       => 'Анонс',
            'report'        => 'Отчет',
        ]"
        required
    />

    <x-form.input
        id="published_at"
        type="datetime-local"
        name="published_at"
        label="Дата публикация"
        value="{{old('post')??($current->published_at??now())}}"
    />

    <x-form.input
        id="image"
        type="file"
        name="image"
        value="{{old('lastname')??@$current->lastname}}"
    />

    <x-form.input
        id="title"
        name="title"
        label="Заголовок"
        value="{{old('title')??@$current->title}}"
        required
    />

    <x-form.editor
        name="short"
        id="short"
        label="Краткое описание"
        value="{{old('short')??@$current->short}}"
    />

    <x-form.editor
        name="full"
        id="full"
        label="Полное описание"
        borderTop
        value="{{old('full')??@$current->full}}"
    />

    <x-form.editor
        name="news"
        id="news"
        label="Новость"
        value="{{old('news')??@$current->news}}"
        borderTop
    />

    <x-form.submit
        class="uppercase"
        value="сохранить"
    />

</form>
