<div
    id="tab_upbringing"
    @class([
        "form_box",
        (old('side_menu') === 'tab_upbringing') ? '' : 'hidden'
    ])
>
    <div class="flex gap-4 items-center bg-white p-4">
        <div class="flex-1 text-lg font-semibold">
            Воспитательная работа
        </div>
        <a
            href="{{ route('api:upbringing:sections:add') }}"
            onclick="Actions.addSection(document.querySelector('.upbringing-sections'), this.href, true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить секцию
            </x-form.button.base-admin>
        </a>
    </div>

    <div class="upbringing-sections">
        @if(old('_token'))
            @foreach(old('upbringing_sections') ?? [] as $id => $section)
                {{
                    view('components.form.upbringing.editor')->with([
                        'section' => (object) $section,
                        'id' => $id,
                        'content' => isset($section['content'])
                    ])
                }}
            @endforeach
        @elseif($current && $current->upbringingSections)
            @foreach($current->upbringingSections as $section)
                {{
                    view('components.form.upbringing.editor', [
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
            href="{{ route('api:upbringing:sections:add') }}"
            onclick="Actions.addSection(document.querySelector('.upbringing-sections'), this.href, true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить секцию
            </x-form.button.base-admin>
        </a>
    </div>
</div>
