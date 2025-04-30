<div class="news_section mt-4 bg-white p-4">
    <div class="flex gap-4 items-center">
    <div class="flex-1">
        <x-form.input
            id="news_{{$news->id}}_title"
            name="title"
            name="sections[{{ $news->id }}][title]"
            value='{{ old("news.{$news->id}.title") ?? $section->title ?? null}}'
            label="Заголовок секции"
            required
        />
    </div>

    <div>
        <a
            href="{{route('news:api:delete',[$news->id])}}"
            onClick="Actions.DeleteSection(this,'.news_section'); return false;"
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
            id="form_news_{{$news->id}}_sort"
            name="sections[{{$news->id??(int)microtime(true)}}][sort]"
            type="number"
            label="Порядок вывода"
            class="text-center"
            value="{{old('order') ?? $section->order ?? null}}"
        />

    </div>

    <div class="flex-1">
        <x-form.checkbox.base
            id="form_news_{{$news->id}}_show"
            name="sections[{{ $news->id }}][is_show]"
            text="Опубликовать секцию"
            class="text-lg"
            :checked="
                    old('_token')
                    ? old('sections.{$news->id}.is_show')
                    : $news->is_show
                "
        />
    </div>


    <div>
        <a
            href="#"
            onclick="this.closest('.news_section').querySelector('.block-content').classList.remove('hidden'); return false;"
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
        id="form_news_{{$news->id}}_content"
        name="sections[{{ $news->id }}][content]"
        label="Контент"
        value="{{old('sections.{$news->id}.content') ?? $news->content ?? null}}"
    />
</div>
</div>
