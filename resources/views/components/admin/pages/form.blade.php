<x-head.tinymce-config/>

<form
    action="{{route('admin:pages:save')}}"
    method="POST"
    enctype="multipart/form-data"
    class="flex flex-col gap-4 max-w-[1200px] mx-auto"
>
    @csrf

    <div class="bg-white p-4">
        <h3 class="pb-2 font-semibold text-xl uppercase text-center">
            @if(isset($current->id))
                Внести изменения
            @else
                Добавить страницу
            @endif
        </h3>

        <hr>

        <x-form.errors/>

        <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>

        <x-form.input
            id="name"
            name="name"
            label="Наименование"
            value="{{old('name')??@$current->name}}"
            required
        />

        <x-form.input
            id="alias"
            name="alias"
            label="Alias"
            value="{{old('alias')??@$current->alias}}"
        />

        <x-form.input
            id="comment"
            name="comment"
            label="Описание"
            value="{{old('comment')??@$current->comment}}"
        />

        <x-form.select
            id="parent_id"
            name="parent_id"
            old="{{old('parent_id')}}"
            value="{{@$current->parent_id}}"
            null="выбрать"
            :list="$pages??[]"
            collection
            label="Parent"
        />

        <x-form.input
            id="route"
            name="route"
            label="Route"
            value="{{old('route')??@$current->route}}"
        />

        <x-form.input
            id="title"
            name="title"
            label="Meta: tile"
            value="{{old('title')??@$current->title}}"
        />

        <x-form.input
            id="keywords"
            name="keywords"
            label="Meta: keywords"
            value="{{old('keywords')??@$current->keywords}}"
        />

        <x-form.input
            id="description"
            name="description"
            label="Meta: description"
            value="{{old('description')??@$current->description}}"
        />

        <x-form.select
            id="menu_id"
            name="menu_id"
            old="{{old('menu_id')}}"
            value="{{@$current->menu_id}}"
            null="выбрать"
            :list="$sidebars??[]"
            collection
            label="Боковое меню"
        />

        <x-form.checkbox
            id="form_without_bg"
            name="without_bg"
            text="убрать фон"
        />

        <x-form.input
            id="view"
            name="view"
            label="View"
            value="{{old('view')??@$current->view}}"
        />

        <x-form.editor
            id="content"
            name="content"
            label="Контент страницы"
            value="{{old('content')??@$current->content}}"
            hideLabel
            height="800px"
        />



    </div>

    <div>
        @php $active = true @endphp
        @component('components.form.sections.contents',compact('current','active'))@endcomponent
    </div>

    <div class="mx-auto inline-block">
        <x-form.submit
            class="uppercase"
            value="сохранить"
        />
    </div>
</form>
