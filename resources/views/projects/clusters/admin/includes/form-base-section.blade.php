<div
    id="{{ $menuItem['tab'] }}"
    @class([
        $menuItem['tabs'],
        (!old('_token') || old('side_menu') === $menuItem['tab'])?'':'hidden'
    ])
>
    <div class="bg-white p-4 flex gap-4 mb-4">
        <div class="flex-1 text-lg font-semibold">
            Основные параметры
        </div>
    </div>

    <div class="bg-white p-4 mb-4">

        @if($current->preview->exists)
            <img src="{{$current->preview->thumbnail}}" alt="123" class="w-full">
        @endif

        <x-form.input
            id="form_name"
            name="name"
            label="Название"
            value="{!! old('_token') ? old('name') : $current->name !!}"
            required
        />

        <x-form.input
            id="form_name"
            name="code"
            label="Alias (unique)"
            value="{!! old('_token') ? old('code') : $current->code !!}"
        />

        <div class="flex gap-4">
            @if($current->ico->exists)
                <div class="py-2 px-3">
                    <img src="{!! $current->ico->image !!}" alt="ico" class="h-10">
                </div>
            @endif

            <div class="flex-1">
                <x-form.file
                    id="form_ico"
                    label="Иконка"
                    name="ico"
                />
            </div>
        </div>
        <div class="flex flex-row gap-4 items-end">
            <div class="flex-1">
                <x-form.input
                    id="form_sort"
                    type="number"
                    step="1"
                    name="sort"
                    label="Порядок вывода"
                    :value="old('_token') ? old('sort') : $current->sort"
                />
            </div>

            <x-form.radio.on-off-alt
                name="is_show"
                block="pb-2"
                :checked="old('_token') ? old('is_show') : ($current->exists ? $current->is_show : true)"
                show="выводиться"
                hide="скрыта"
            />
        </div>

        <x-form.file
            id="form_division_image"
            label="Превью"
            name="image"
        />

        <x-form.input
            id="form_division_preview"
            name="preview"
            label="Превью из галереи"
            value="{{old('preview') ?? $current->preview->exists ? $current->preview->src : null}}"
        />


    </div>

    <div class="bg-stone-50 p-4 mb-4">
        <x-form.editor
            id="short-description"
            name="short"
            label="Краткое описание"
            value="{{old('short') ?? $current->short ?? null}}"
        />
    </div>

    <div class="bg-stone-50 p-4 mb-4">
        <x-form.editor
            id="full-description"
            name="full"
            label="Полное описание"
            value="{{old('full') ?? $current->full ?? null}}"
        />
    </div>

</div>
