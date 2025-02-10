<form
    action="{{route('admin:menu-items:save')}}"
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

    <x-form.errors/>

    <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>

    <x-form.select
        id="menu_id"
        name="menu_id"
        nullDisabled
        old="{{old('menu_id')}}"
        value="{{@$current->menu_id}}"
        null="Выбрать"
        :list="$menu??[]"
        label="Меню"
        collection
        required
        onchange="DependedSelects.LimitList('parent_id','data-menu',this.value)"
    />

    <x-form.select
        id="parent_id"
        name="parent_id"
        old="{{old('parent_id')}}"
        value="{{@$current->parent_id}}"
        null="Выбрать"
        :list="$parents??[]"
        collection
        label="Родительский пункт"
    />

    <x-form.input
        id="name"
        name="name"
        label="Наименование"
        value="{{old('name')??@$current->name}}"
        required
    />

    <x-form.input
        id="grp"
        name="grp"
        label="Группа"
        value="{{old('grp')??@$current->grp}}"
    />

    <x-form.input
        id="comment"
        name="comment"
        label="Описание"
        value="{{old('comment')??@$current->comment}}"
    />

    <x-form.select
        id="page_id"
        name="page_id"
        {{--        nullDisabled--}}
        old="{{old('page_id')}}"
        value="{{@$current->page_id}}"
        null="выбрать"
        label="Страница"
        :list="$pages??[]"
        collection
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
