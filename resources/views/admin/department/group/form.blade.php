<x-head.tinymce-config/>
<form
    action="{{route('admin:department-group:save')}}"
    method="POST"
    enctype="multipart/form-data"
    @class([
        "p-4 bg-white rounded-md",
        "max-w-1200",
        "mx-auto",
    ])
>
    @csrf

    <div class="flex gap-3 justify-center items-center">
        <h3 class="font-semibold text-xl uppercase text-center flex-1">
            @if(isset($current->id))
                Редактирование группы
            @else
                Добавить группу
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
        @if(optional($current)->preview && $current->preview->thumbnail)
            <div>
                <img
                    src="{{optional($current->preview)->thumbnail}}"
                    alt="{{optional($current)->name}}"
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
                value="{{ old('name') ?? optional($current)->name }}"
                required1
            />

            <div class="block md:flex flex-row gap-4 items-center">
                <div class="flex-1">
                    <x-form.input
                        id="form_alias"
                        name="alias"
                        label="Alias"
                        value="{{ old('alias') ?? optional($current)->alias }}"
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
                        value="{{old('order')??optional($current)->order}}"
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
