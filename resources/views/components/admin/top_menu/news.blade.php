<div class="bg-white rounded-md p-4 flex">
    <x-html.a-blue
        href="{{route('admin:news')}}"
        text="Новости"
        active="{!! ($active==='news')?true:null !!}"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:events')}}"
        text="Мероприятия"
        active="{!! ($active==='events')?true:null !!}"
    />

</div>
