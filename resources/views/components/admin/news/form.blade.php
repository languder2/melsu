<x-head.tinymce-config/>
<form
    action="{{route('admin:news:save')}}"
    method="POST"
    enctype="multipart/form-data"
    class="
        p-4 bg-white rounded-md
        max-w-[1200px]
        mx-auto
    "
>
    @csrf

    <h3 class="pb-2 font-semibold text  -xl uppercase text-center">
        @if(isset($current->id))
            Внести изменения
        @else
            Добавить новость
        @endif
    </h3>

    <hr>

    <x-form.errors/>

    <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>

    <div class="flex gap-4">

        @if(optional($current)->preview && optional($current->preview)->src)
        <div>
            <img src="{{$current->preview->src}}" alt="1"
                class="max-h-68"
            />
        </div>
        @elseif(optional($current)->image)
            <div>
                <img src="{{$current->image}}" alt="1"
                     class="max-h-68"
                />
            </div>
        @endif

        <div class="flex-1">
            <x-form.input
                id="title"
                name="title"
                label="Заголовок"
                value="{{old('title')??@$current->title}}"
                required
            />

            <x-form.select
                id="category"
                name="category"
                nullDisabled
                old="{{old('category')}}"
                value="{{@$current->category}}"
                null="Выберите категорию"
                :list="$categories??[]"
                required
            />

            <x-form.input
                id="publication_at"
                type="datetime-local"
                name="publication_at"
                label="Дата публикация"
                value="{{old('post')??($current?->getAttributes()['publication_at']??now())}}"
            />

            <x-form.file
                id="form_image"
                label="Preview"
                name="image"
            />

            <x-form.input
                id="form_preview"
                name="preview"
                label="Картинка из галереи"
                value="{{old('preview')??optional(optional($current)->preview)->src}}"
            />

        </div>
    </div>

    <x-form.editor
        name="short"
        id="short"
        label="Краткое описание"
        value="{{old('short')??@$current->short}}"
    />

    <x-form.editor
        name="full"
        id="full"
        label="Полное описание"
        borderTop
        value="{{old('full')??@$current->full}}"
    />

    <x-form.editor
        name="news"
        id="news"
        label="Новость"
        value="{{old('news')??@$current->news}}"
        borderTop
        class="min-h-screen"
    />

    <x-form.submit
        class="uppercase"
        value="сохранить"
    />

</form>
