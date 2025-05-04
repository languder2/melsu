<section
    class="bg-white p-4 flex gap-4 block-document"
>
    <div class="flex-1">

        <x-form.input
            id="title"
            name="documents[{{ $item->id }}][title]"
            label="Название файла"
            value="{{ old('_token') ? old('title') : $item->title }}"
        />

        <div class="flex gap-4 items-end">
            <div class="flex-1">
                <x-form.input
                    id="form_sort"
                    name="documents[{{ $item->id }}][sort]"
                    type="number"
                    step="1"
                    label="Порядок вывода"
                    value="{{ old('_token') ? old('sort') : $item->sort }}"
                />
            </div>
            <x-form.radio.on-off-alt
                name="documents[{{ $item->id }}][is_show]"
                block="pb-2"
                :checked="old('_token') ? old('is_show') : ($item->title ? $item->is_show : true)"
            />

        </div>

        <div class="flex flex-col gap-4">
            @component('components.form.file',[
                'id'        => 'file',
                'label'     => 'Document',
                'name'      => "documents_{$item->id}",
            ])@endcomponent

            @if($item->title)
                <a
                    href="{{ Storage::url($item->filename) }}"
                    target="_blank"
                    class="flex gap-4"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="currentColor" class="bi bi-filetype-pdf"
                         viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                    </svg>

                    {{ $item->filename }}
                </a>
            @endif
        </div>


    </div>
    <div>
        <a
            href="{{ route('documents:api:delete',$item) }}"
            class="
                inline-block
                hover:text-red-700
                active:text-gray-700
            "
            onclick="Actions.VacatePosition(this,'.block-document',true); return false;"
            title="Удалить документ"

        >
            <i class="fas fa-trash w-4 h-4"></i>
        </a>
    </div>
</section>
