<div
    id="tab_partner"
    @class([
        "form_box",
        (old('side_menu') === 'tab_partner') ? '' : 'hidden'
    ])
>
    <div class="flex gap-4 items-center bg-white p-4">
        <div class="flex-1 text-lg font-semibold">
            Партнеры
        </div>
        <a
            href="{{ route('api:partner:sections:add') }}"
            onclick="Actions.addSection(document.querySelector('.partner-sections'), this.href, true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить секцию
            </x-form.button.base-admin>
        </a>
    </div>

    <div class="partner-sections">
        @if(old('_token'))
            @foreach(old('partner_sections') ?? [] as $id => $section)
                {{
                    view('components.form.partner.editor')->with([
                        'section' => (object) $section,
                        'id' => $id,
                        'content' => isset($section['content'])
                    ])
                }}
            @endforeach
        @elseif($current && $current->partnerSections)
            @foreach($current->partnerSections as $section)
                {{
                    view('components.form.partner.editor', [
                        'section' => $section,
                        'id' => $section->id,
                    ])
                }}
            @endforeach
        @endif
    </div>

    <div class="flex gap-4 items-center bg-white p-4 mt-4">
        <div class="flex-1 text-lg font-semibold"></div>
        <a
            href="{{ route('api:partner:sections:add') }}"
            onclick="Actions.addSection(document.querySelector('.partner-sections'), this.href, true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить секцию
            </x-form.button.base-admin>
        </a>
    </div>
</div>
