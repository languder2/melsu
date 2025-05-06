<nav class="bg-white p-4 mb-4 flex">
    <x-html.a-blue
        href="{{route('news-categories:admin:list')}}"
        text="Категории"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('admin:news')}}"
        text="Новости"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('admin:events')}}"
        text="Мероприятия"
    />

</nav>



