<div class="content_faq mt-4 bg-white p-4">
    <div class="flex gap-4 items-center">
        <div class="flex-1">
            <x-form.input
                id="form_faq_{{$id}}_question"
                name="faq[{{$id??(int)microtime(true)}}][question]"
                value="{{ old('faq.{$id}.question') ?? $faq->question ?? null}}"
                label="Вопрос"
            />
        </div>

        <div>
            <a
                href="{{route('api:faq:delete',[$id])}}"
                onClick="Actions.DeleteSection(this,'.content_faq'); return false;"
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
                id="form_faq_{{$id}}_order"
                name="faq[{{$id??(int)microtime(true)}}][order]"
                type="number"
                label="Порядок вывода"
                class="text-center"
                value="{{old('order') ?? $faq->order ?? null}}"
            />

        </div>

        <div>
            <x-form.checkbox.base
                id="form_faq_{{$id}}_show"
                name="faq[{{$id??(int)microtime(true)}}][show]"
                text="Опубликовать вопрос"
                class="text-lg"
                :checked="
                    old('_token')
                    ? old('faq.{$id}.show')
                    : $faq->show ?? null
                "
            />
        </div>


        <div>
            <a
                href="#"
                onclick="this.closest('.content_faq').querySelector('.block-faq').classList.remove('hidden'); return false;"
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
            "block-faq",
            $answer??"hidden"
        ])
    >
        <x-form.editor
            id="form_faq_{{$id}}_answer"
            name="faq[{{$id??(int)microtime(true)}}][answer]"
            label="Ответ"
            value="{{old('faq.{$id}.answer') ?? $faq->answer ?? null}}"
        />
    </div>
</div>
