<div class="bg-white rounded-md p-4 mb-4 flex">
    <x-html.a-blue
        href="{{route('admin:gallery:image:list')}}"
        text="Изображения"
        :active="str_contains(url()->current(),route('admin:gallery:image:list'))"
    />

    <span class="inline-block mx-3">
        /
    </span>

    <x-html.a-blue
        href="{{route('admin:gallery:video:list')}}"
        text="Видео"
        :active="str_contains(url()->current(),route('admin:gallery:video:list'))"
    />
</div>
