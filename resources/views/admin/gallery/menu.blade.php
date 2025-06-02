<div class="bg-white rounded-md p-4 mb-4 flex">
    <div class="mr-3">
        Изображения:
    </div>

    <x-html.a-blue
        href="{{route('admin:gallery:list')}}"
        text="Галереи"
        :active="str_contains(url()->current(),route('admin:gallery:list'))"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:image:list')}}"
        text="Списки"
        :active="str_contains(url()->current(),route('admin:image:list'))"
    />

    <span class="inline-block mx-3">
        |
    </span>

    <div class="mr-3">
        Видео:
    </div>

    <x-html.a-blue
        href="{{route('admin:gallery:list')}}"
        text="Галереи"
        :active="str_contains(url()->current(),route('admin:image:list'))"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:gallery:list')}}"
        text="Списки"
        :active="str_contains(url()->current(),route('admin:image:list'))"
    />

</div>
