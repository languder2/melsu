<x-head.tinymce-config/>
<form
    action="{{ $gallery->save }}"
    method="POST"
    enctype="multipart/form-data"
    @class([
        "p-4 bg-white rounded-md",
        "max-w-[1200px]",
        "mx-auto",
    ])
>
    @csrf

    <div class="flex gap-3 justify-center items-center">
        <h3 class="font-semibold text-xl uppercase text-center flex-1">
            @if(isset($gallery->exists))
                Измененить галерею
            @else
                Создать галерею
            @endif
        </h3>
        <div class="py-2">
            <x-form.button
                class="uppercase"
                value="сохранить"
            />
        </div>
    </div>

    <hr class="opacity-40">

    <x-form.errors/>

    <div class="flex gap-3 mt-3">
        @if($gallery->preview()->exists)
            <div>
                <img
                    src="{{$gallery->thumbnail}}"
                    alt="{{$gallery->name}}"
                    class="h-56 rounded-lg"
                />
            </div>
        @endif

        <div class="flex-1">
            <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>

            <x-form.input
                id="form_name"
                name="name"
                label="Название"
                value="{{ old('_token') ? old('name') : $gallery->name }}"
                required1
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
                value="{{ old('_token') ? old('preview') : $gallery->preview->src ?? null }}"
            />

            <div class="block md:flex flex-row gap-4 items-center">
                <div class="flex-1">
                    <x-form.input
                        id="form_code"
                        name="code"
                        label="Code"
                        value="{{ old('_token') ? old('code') : $gallery->code }}"
                        required
                    />
                </div>
                <span class="w-full md:w-40">
                    <x-form.input
                        id="form_order"
                        name="order"
                        type="number"
                        label="Порядок вывода"
                        class="text-center"
                        value="{{ old('_token') ? old('order') : $gallery->order }}"
                    />
                </span>

                <x-form.on-off
                    :old="old('show')"
                    :current="$gallery"
                />
            </div>
        </div>
    </div>

    <x-form.editor
        id="form_description"
        name="description"
        label="Описание"
        borderTop
        value="{{ old('_token') ? old('description') : $gallery->description }}"
    />

    <x-form.submit
        class="uppercase"
        value="сохранить"
    />
</form>
