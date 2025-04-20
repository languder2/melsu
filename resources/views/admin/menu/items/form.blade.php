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

    @if($current)
        <img
            src="{{$current->preview->thumbnail}}"
            alt="{{$current->preview->name}}"
            class="max-h-50 rounded-md object-contain w-full"
        >
    @endif

    <x-form.input
        id="name"
        name="name"
        label="Наименование"
        value="{{old('name')??@$current->name}}"
        required
    />

    <div class="grid grid-cols-2 gap-4">

        <div>
            <x-form.select
                id="menu_id"
                name="menu_id"
                nullDisabled
                old="{{old('menu_id')}}"
                value="{{ $current->menu_id ?? null}}"
                null="Выбрать"
                :list="$menu??[]"
                label="Меню"
                required
                onchange="Actions.changeSelectOptions(
                            'parent_id',
                            '{{route('api:menu-items:parents:get')}}/'+this.value+'{{isset($current->id) ? '/'.$current->id : null}}'
                        )"
            />
        </div>
        <div>
            <x-form.select
                id="parent_id"
                name="parent_id"
                old="{{old('parent_id')}}"
                value="{{$current->parent_id ?? null}}"
                null="Выбрать"
                :list="$parents??[]"
                label="Родительский пункт"
            />
        </div>
    </div>

    <x-form.file
        id="form_department_image"
        label="Превью"
        name="image"
    />

    <x-form.input
        id="form_department_preview"
        name="preview"
        label="Превью из галереи"
        value="{{old('preview')??optional(optional($current)->preview)->src}}"
    />


    {{--    <x-form.input--}}
    {{--        id="comment"--}}
    {{--        name="comment"--}}
    {{--        label="Описание"--}}
    {{--        value="{{old('comment')??@$current->comment}}"--}}
    {{--    />--}}

    <div class="grid gap-4 grid-cols-2">
        <div>
            <x-form.select
                id="page_id"
                name="page_id"
                old="{{old('page_id')}}"
                value="{{@$current->page_id}}"
                null="выбрать"
                label="Страница"
                :list="$pages??[]"
            />
        </div>

        <div class="pt-3">
            <x-form.input
                id="route"
                name="route"
                label="Route"
                value="{{old('route')??@$current->route}}"
            />
        </div>
    </div>

    <div class="grid gap-4 grid-cols-[1fr_150px_100px]">

        <div>
            <x-form.input
                id="link"
                name="link"
                label="Link"
                value="{{old('link')??@$current->link}}"
            />
        </div>

        <div>
            <x-form.input
                id="sort"
                type="number"
                name="sort"
                label="Порядок вывода"
                value="{{old('sort')??@$current->sort??1000}}"
            />
        </div>

        <div class="pt-5">
            <x-form.on-off
                :old="old('show')"
                :current="$current"
            />
        </div>
    </div>

    <x-form.submit
        class="uppercase"
        value="сохранить"
    />

</form>
