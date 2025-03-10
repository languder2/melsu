<div
    id="tab_base"
    @class([
        "form_box",
        (!old('_token') || old('side_menu') === 'tab_base')?'':'hidden'
    ])
>
    <div class="bg-stone-50 p-4 flex gap-4 mb-4">
        <div class="flex-1 text-lg font-semibold">
            Базовые параметры
        </div>
    </div>


    <div class="bg-stone-50 p-4 mb-4">

        <div class="flex gap-4">
            <div class="w-24">
                <x-form.input
                    id="form_acronym"
                    name="acronym"
                    label="Акроним"
                    value="{{old('acronym')?? $current->acronym ?? null}}"
                    required
                />
            </div>

            <div class="flex-1">
                <x-form.input
                    id="form_name"
                    name="name"
                    label="Название"
                    value="{{old('name')?? $current->name ?? null}}"
                    required
                />
            </div>

            <div class="w-30">

                <x-form.select
                    id="form_faculty_type"
                    name="type"
                    old="{{old('type')?? $current->type ?? 'faculty'}}"
                    :list="[
                        'faculty'   => 'Факультет',
                        'branch'    => 'Филиал',
                    ]"
                    label="Тип"
                />

            </div>

        </div>

        <div class="flex gap-4 my-2">
            @if($current)
                <img src="{{$current->logo->thumbnail}}" alt="123" class="h-44 rounded-md">
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
                    value="{{old('preview')?? optional($current)->logo->src ?? null}}"
                />

            </div>
        </div>
    </div>


    <div class="bg-stone-50 p-4 mb-4">
        <x-form.editor
            id="form_description"
            name="description"
            label="Описание"
            value="{{old('description')??@$current->description}}"
        />
    </div>

</div>

