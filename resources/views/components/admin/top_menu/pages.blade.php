<div class="bg-white rounded-md p-4 mb-4 flex">
    <x-html.a-blue
        href="{{route('admin:pages')}}"
        text="Страницы"
        active="{!! ($active==='pages')?true:null !!}"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:menu')}}"
        text="Список меню"
        active="{!! ($active==='menu')?true:null !!}"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:menu-categories')}}"
        text="Категории меню"
        active="{!! ($active==='menu-categories')?true:null !!}"
    />

</div>
