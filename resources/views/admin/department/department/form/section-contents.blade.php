<div
    id="tab_department_contents"
    @class([
        "department_form_box",
        (old('side_menu') === 'tab_department_contents')?'':'hidden'
    ])
>

    <div class="flex gap-4 items-center bg-white p-4">
        <div class="flex-1 text-lg font-semibold">
            Секции контента
        </div>
        <a
            href="{{route('api:content:sections:add')}}"
            onclick="Actions.addSection(document.querySelector('.sections'),this.href,true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить секцию
            </x-form.button.base-admin>
        </a>
    </div>

    <div class="sections">
        @if(old('_token') && is_array(old('sections')))
            @foreach(old('sections') as $id=>$section)
                    {{
                        view('admin.page.content.editor')
                        ->with([
                            'section'   => (object)$section,
                            'id'        => $id,
                            'content'   => isset($section['content'])
                        ])
                    }}
            @endforeach
        @elseif($current && $current->sections->count())
            @foreach($current->sections as $section)
                    {{
                        view('admin.page.content.editor',[
                            'section'   => $section,
                            'id'        => $section->id,
                        ])
                    }}
            @endforeach
        @endif
    </div>
    <div class="flex gap-4 items-center bg-white p-4 mt-4">
        <div class="flex-1 text-lg font-semibold">
        </div>
        <a
            href="{{route('api:content:sections:add')}}"
            onclick="Actions.addSection(document.querySelector('.sections'),this.href,true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить секцию
            </x-form.button.base-admin>
        </a>
    </div>
</div>


