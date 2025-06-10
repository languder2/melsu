<nav class="bg-white p-4 flex">

    <x-html.a-blue
        href="{{route('document-categories:admin:list')}}"
        text="Категории документов"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{route('documents:admin:list')}}"
        text="Документы"
    />

</nav>



