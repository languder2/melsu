@php
    $id = $item->id ?? (int)microtime(true)
@endphp
<div class="content_career mt-4 bg-white p-4">
    <div class="flex gap-4 items-center">

        <input type="text" name="career[{{$id}}][id]" value="{{$id}}">

        <div class="flex-1">
            <x-form.input
                id="form_career_{{$id}}_name"
                name="career[{{$id}}][name]"
                value="{{ $item->name ?? null}}"
                label="Название"
            />
        </div>

        <div>
            <a
                href="{{route('api:career:delete',[$id])}}"
                onClick="Actions.DeleteSection(this,'.content_career'); return false;"
                class="
                inline-block
                bg-gray-100 px-3 py-2 rounded-lg
                transition-all duration-200
                hover:text-white hover:bg-red-700
                hover:-mt-2px hover:mb-2px
                hover:shadow-md hover:shadow-gray-400
            "
            >
                <i class="fas fa-recycle"></i>
            </a>
        </div>

    </div>

    <div class="flex gap-4 items-center mt-3">
        <div>
            <x-form.input
                id="form_career_{{$id}}_salary"
                name="career[{{$id}}][salary]"
                type="number"
                label="Оклад, тыс. руб."
                class="text-center"
                value="{{$item->salary ?? null}}"
            />

        </div>
        <div class="flex-1">
            <x-form.input
                id="form_career_{{$id}}_sort"
                name="career[{{$id}}][sort]"
                type="number"
                label="Порядок вывода"
                class="text-center"
                value="{{$item->sort ?? null}}"
            />

        </div>

        <div>

            <x-form.checkbox.base
                id="form_career_{{$id}}_active"
                name="career[{{$id}}][active]"
                text="Опубликовать"
                class="text-lg"
                :checked="$item->active ?? null"
            />
        </div>


        <div>
            <a
                href="#"
                onclick="this.closest('.content_career').querySelector('.block-career').classList.remove('hidden'); return false;"
                class="
                inline-block
                bg-gray-100 px-3 py-2 rounded-lg
                transition-all duration-200
                hover:text-white hover:bg-green-700
                hover:-mt-2px hover:mb-2px
                hover:shadow-md hover:shadow-gray-400
            "
            >
                <i class="fas fa-pencil-alt"></i>
            </a>
        </div>

    </div>

    <div
        @class([
            "block-career",
            isset($is_new) ? '' : "hidden"
        ])
    >
        <x-form.editor
            id="form_career_{{$id}}_content"
            name="career[{{$id}}][content]"
            label="Ответ"
            value="{{$item->content ?? null}}"

        />
    </div>
</div>
