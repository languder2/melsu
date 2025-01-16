<form
    action="{{route('admin:menu:save')}}"
    method="POST"
    enctype="multipart/form-data"
    class="
        p-4 bg-white rounded-md
        max-w-[1200px]
        mx-auto
    "
>
    @csrf

    <h3 class="pb-2 font-semibold text-xl uppercase text-center">
        @if(isset($current->id))
            Внести изменения
        @else
            Добавить пункт меню
        @endif
    </h3>

    <hr>

    <x-form.errors />

    <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>

    <x-form.select
        id="category"
        name="category"
        nullDisabled
        old="{{old('category')}}"
        value="{{@$current->category}}"
        null="Выберите категорию"
        :list="$categories??[]"
        collection
        required
    />

    <x-form.input
        id="name"
        name="name"
        label="Наименование"
        value="{{old('name')??@$current->name}}"
        required
    />

    <x-form.input
        id="comment"
        name="comment"
        label="Описание"
        value="{{old('comment')??@$current->comment}}"
    />

    <x-form.select
        id="parent"
        name="parent"
        old="{{old('parent')}}"
        value="{{@$current->parent}}"
        null="Родительский пункт"
        :list="$parent??[]"
    />

    <x-form.input
        id="route"
        name="route"
        label="Route"
        value="{{old('route')??@$current->route}}"
    />

    <x-form.input
        id="link"
        name="link"
        label="Link"
        value="{{old('link')??@$current->link}}"
    />

    <x-form.input
        id="sort"
        type="number"
        name="sort"
        label="Sort"
        value="{{old('sort')??@$current->sort??1000}}"
    />

    <x-form.submit
        class="uppercase"
        value="сохранить"
    />

</form>
