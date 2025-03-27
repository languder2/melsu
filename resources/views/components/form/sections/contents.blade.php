<div
    id="tab_contents"
    @class([
        "form_box",
        (old('side_menu') === 'tab_contents' || isset($active))?'':'hidden'
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
        @if(old('_token'))
            @foreach(old('sections') ?? [] as $id=>$section)
                {{
                    view('admin.page.content.editor')
                    ->with([
                        'section'   => (object)$section,
                        'id'        => $id,
                        'content'   => isset($section['content'])
                    ])
                }}
            @endforeach
        @elseif($current)
            @foreach($current->sections(false)->get() as $section)
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


