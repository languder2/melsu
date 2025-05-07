<div class="news_section mt-4 bg-white p-4 flex flex-col gap-4">
    <div class="flex gap-4">
        <div class="order-2 flex flex-col gap-8 pt-2 justify-between">
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

            <a
                href="#"
                onclick="this.closest('.news_section').querySelector('.block-content').classList.toggle('hidden'); return false;"
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

        <div class="flex-1 flex flex-col">
            <x-form.input
                id="news_{{$news->id}}_title"
                name="title"
                name="news[{{ $news->id }}][title]"
                value='{{ old("news.{$news->id}.title") ?? $news->title ?? null}}'
                label="Заголовок новости"
                required
            />

            <div class="flex flex-row gap-4 items-end">
                <div class="flex-1">
                    <x-form.input
                        id="published_at"
                        type="datetime-local"
                        name="news[{{ $news->id }}][published_at]"
                        label="Дата публикация"
                        value="{{ old('_token') ?? ($news->getAttributes()['published_at'] ?? now()) }}"
                    />
                </div>

                <div class="flex-1">
                    <x-form.input
                        id="form_sort"
                        type="number"
                        step="1"
                        name="news[{{ $news->id }}][sort]"
                        label="Порядок вывода"
                        :value="old('_token') ? old('sort') : $news->sort ?? $sort ?? null "
                    />
                </div>

                <x-form.radio.on-off-alt
                    name="news[{{ $news->id }}][is_favorite]"
                    block="pb-2"
                    :checked="old('_token') ? old('is_favorite') : ($news->exists ? $news->is_favorite : false)"
                    show="закрепленная"
                    hide="стандартная"
                />
                <x-form.radio.on-off-alt
                    name="news[{{ $news->id }}][is_show]"
                    block="pb-2"
                    :checked="old('_token') ? old('is_show') : ($news->exists ? $news->is_show : true)"
                    show="выводиться"
                    hide="скрытая"
                />
            </div>


            <x-form.file
                id="form_image"
                label="Preview"
                name="news[{{ $news->id }}][image]"
            />

            <x-form.input
                id="form_preview"
                name="news[{{ $news->id }}][preview]"
                label="Картинка из галереи"
                value="{{old('_token') ? old('preview') : $news->preview->src ?? null}}"
            />

        </div>
    </div>

    <div
        @class([
            "block-content flex flex-col gap-4",
            $news->exists ? "hidden" : "block"
        ])
    >
{{--        <div>--}}
{{--            <x-form.editor--}}
{{--                id="form_news_{{ $news->id }}_short"--}}
{{--                name="news[{{ $news->id }}][short]"--}}
{{--                label="Краткий текст новости"--}}
{{--                value="{{ old('_token') ?? old('sections.{$news->id}.short') ?? $news->short ?? null}}"--}}
{{--            />--}}
{{--        </div>--}}

        <div>
            <x-form.editor
                id="form_news_{{ $news->id }}_content"
                name="news[{{ $news->id }}][content]"
                label="Полный текст новости"
                value="{{ old('_token') ?? old('sections.{$news->id}.content') ?? $news->content ?? null}}"
            />
        </div>
    </div>
</div>
