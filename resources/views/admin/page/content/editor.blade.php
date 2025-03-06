<div class="content_section mt-4 bg-white p-4">
    <div class="flex gap-4 items-center">
    <div class="flex-1">
        <x-form.input
            id="form_section_{{$id}}_title"
            name="test"
            name="sections[{{$id??(int)microtime(true)}}][title]"
            value="{{ old('sections.{$id}.title') ?? $section->title ?? null}}"
            label="Заголовок секции"
            required
        />
    </div>

    <div>
        <a
            href="{{route('api:page:contents:section:delete',[$id])}}"
            onClick="Actions.DeleteSection(this,'.content_section'); return false;"
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
    <div class="flex-1">
        <x-form.input
            id="form_sections_{{$id}}_order"
            name="sections[{{$id??(int)microtime(true)}}][order]"
            type="number"
            label="Порядок вывода"
            class="text-center"
            value="{{old('order') ?? $section->order ?? null}}"
        />

    </div>

    <div class="flex-1">
        <x-form.checkbox.base
            id="form_sections_{{$id}}_show_title"
            name="sections[{{$id??(int)microtime(true)}}][show_title]"
            text="Выводить заголовок"
            class="text-lg"
            :checked="
                    old('_token')
                    ? old('sections.{$id}.title')
                    : $section->show_title ?? null
                "
        />

    </div>
    <div class="flex-1">
        <x-form.checkbox.base
            id="form_sections_{{$id}}_show"
            name="sections[{{$id??(int)microtime(true)}}][show]"
            text="Опубликовать секцию"
            class="text-lg"
            :checked="
                    old('_token')
                    ? old('sections.{$id}.title')
                    : $section->show ?? null
                "
        />
    </div>


    <div>
        <a
            href="#"
            onclick="this.closest('.content_section').querySelector('.block-content').classList.remove('hidden'); return false;"
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
        "block-content",
        $content??"hidden"
    ])
>
    <x-form.editor
        id="form_sections_{{$id}}_content"
        name="sections[{{$id??(int)microtime(true)}}][content]"
        label="Контент"
        value="{{old('sections.{$id}.content') ?? $section->content ?? null}}"
    />
</div>
</div>
