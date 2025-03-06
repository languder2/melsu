<x-head.tinymce-config/>

<form
    action="{{route('admin:education:labs:save')}}"
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
            Добавить лабораторию
        @endif
    </h3>

    <hr>

    <x-form.errors/>

    <x-form.input type="hidden" name="id" value="{{$current->id ?? null}}"/>

    <x-form.select
        id="form_department"
        name="department_id"
        old="{{old('department_id')}}"
        value="{{$current?->department_code}}"
        null="Выбрать"
        :list="$departments"
        label="Кафедра"
    />

    <x-form.input
        id="form_name"
        name="name"
        label="Название"
        value="{{old('name') ?? $current->name ?? null}}"
        required
    />

    <div class="flex gap-4 my-2">
        @if($current)
            <img src="{{$current->preview->thumbnail}}" alt="{{$current->preview->name}}" class="h-44 rounded-md">
        @endif

        <div class="flex-1">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="flex-1">
                    <x-form.input
                        id="form_code"
                        name="code"
                        label="Alias"
                        value="{{ old('code') ?? optional($current)->code }}"
                    />
                </div>
                <span class="w-full md:w-40">
                        <x-form.input
                            id="form_order"
                            name="sort"
                            type="number"
                            label="Порядок вывода"
                            class="text-center"
                            value="{{old('sort')??optional($current)->sort}}"
                        />
                    </span>

                <x-form.on-off
                    :old="old('show')"
                    :current="$current"
                />
            </div>

            <x-form.file
                id="form_image"
                label="Превью"
                name="image"
            />

            <x-form.input
                id="form_preview"
                name="preview"
                label="Превью из галереи"
                value="{{old('preview')?? optional($current)->preview->src ?? null}}"
            />

        </div>
    </div>


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


