<div class="content_section mt-4 bg-white p-4 flex flex-col gap-4">
    <div class="flex gap-4 items-center">
        <div class="order-2 flex flex-col gap-8 pt-2 justify-between">
            <a
                href="#"
                onclick="this.closest('.content_section').querySelector('.block-content').classList.toggle('hidden'); return false;"
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

        <div class="flex-1 flex flex-col font-semibold text-2xl">
            {{ $content->getName() }}
        </div>
    </div>

    <div
        @class([
            "block-content flex flex-col gap-4",
            $content->exists ? "hidden" : "block"
        ])
    >

        <div>
            <x-form.editor
                id="form_news_{{ $content->id }}_content"
                name="contents[{{ $content->type }}]"
                value="{{ old('_token') ?? old('contents.{$content->type}') ?? $content->content ?? null}}"
            />
        </div>
    </div>
</div>
