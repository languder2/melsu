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
            href="{{route('news:api:add-section')}}"
            onclick="Actions.addSection(document.querySelector('.news'),this.href,true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить секцию
            </x-form.button.base-admin>
        </a>
    </div>

    <div class="news">
        @if(old('_token'))
        @elseif($current)
            @foreach($current->news as $news)
                @component('news.admin.includes.block',[
                    'news'      => $news
                ])@endcomponent
            @endforeach
        @endif
    </div>
    <div class="flex gap-4 items-center bg-white p-4 mt-4">
        <div class="flex-1 text-lg font-semibold">
        </div>
        <a
            href="{{route('news:api:add-section')}}"
            onclick="Actions.addSection(document.querySelector('.news'),this.href,true); return false;"
        >
            <x-form.button.base-admin class="cursor-pointer">
                Добавить секцию
            </x-form.button.base-admin>
        </a>
    </div>
</div>


{{--@component('news.admin.includes.block',[--}}
{{--    'news'      => new \App\Models\News\RelationNews()--}}
{{--])@endcomponent--}}
