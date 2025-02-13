<x-head.tinymce-config/>
<form
    action="{{route('admin:gallery:image:save')}}"
    method="POST"
    enctype="multipart/form-data"
    @class([
        "p-4 bg-white rounded-md",
        "max-w-[1200px]",
        "mx-auto",
    ])
>
    @csrf

    <div class="flex">
        <div class="h-60">
            <img src="{{optional($current)->thumbnail}}" alt="" class="h-60" />
        </div>
        <div class="flex-1">
            <h3 class="pb-2 font-semibold text-xl uppercase text-center">
                @if(isset($current->id))
                    Измененить галерею
                @else
                    Создать галерею
                @endif
            </h3>

            <hr>

            <x-form.errors/>

            <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>

            <x-form.input
                id="form_name"
                name="name"
                label="Название"
                value="{{ old('name') ?? optional($current)->name }}"
                required
            />

            <x-form.input
                id="form_code"
                name="code"
                label="Code"
                value="{{ old('code') ?? optional($current)->code }}"
                required
            />

            <x-form.file
                id="form_image"
                label="Превью"
                name="image"
            />

            <x-form.input
                id="form_preview"
                name="preview"
                label="Превью из галереи"
                value="{{old('preview')??optional(optional($current)->preview)->src}}"
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
