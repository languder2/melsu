<div class="bg-white rounded-md p-4 flex">
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
        text="Меню"
        active="{!! ($active==='menu')?true:null !!}"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:menu-items')}}"
        text="Пункты меню"
        active="{!! ($active==='menu-items')?true:null !!}"
    />

</div>
