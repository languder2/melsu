<div
    id="{{ $slot }}"
    @class([
        "form_box",
        (old('side_menu') === $slot || isset($active))?'':'hidden'
    ])
>
    <div class="flex gap-4 items-center bg-white p-4">
        <div class="flex-1 text-lg font-semibold">
            Новости
        </div>

        <a
            href="{{route('news:api:add')}}"
            onclick="Actions.addSection(document.querySelector('.news'),this.href,true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить секцию
            </x-form.button.base-admin>
        </a>
    </div>

    <div class="news">
        @if(old('_token'))
            @foreach(old('sections') ?? [] as $id=>$section)
                @component('news.admin.includes.block')@endcomponent

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


        @component('news.admin.includes.block',[
            'news'      => new \App\Models\News\RelationNews()
        ])@endcomponent

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


