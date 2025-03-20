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
            Добавить категорию меню
        @endif
    </h3>

    <hr>

    <x-form.errors/>

    <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>

    <div class="flex gap-4">
        @if($current->ico)
            <div class="stroke-green fill-red w-16 h-16 fill-blue-600 stroke-purple-600 hover:stroke-amber-600 hover:fill-red-600">
                {!! @file_get_contents(public_path($current->ico->image)) !!}
            </div>
        @endif

        <div class="flex-1">
            <x-form.file
                id="form_ico"
                label="Иконка"
                name="ico"
            />
        </div>
    </div>

    <x-form.input
        id="name"
        name="name"
        label="Заголовок"
        value="{{old('name')??@$current->name}}"
        required
    />

    <x-form.input
        id="code"
        name="code"
        label="Код"
        value="{{old('code')??@$current->code}}"
    />


    <div class="flex gap-4 items-end">
        <div>
            <x-form.checkbox.base
                id="form_is_tree"
                name="is_tree"
                text="Древовидное"
                :checked="
                    old('_token')
                    ? old('is_tree')
                    : $current->is_tree ?? null
                "
            />

        </div>

        <div class="flex-1">
            <x-form.select
                id="form_department_parent_id"
                name="parent_id"
                old="{{old('parent_id')?? $addTo ?? null}}"
                value="{{$current->parent_id ?? null}}"
                null="Выбрать"
                :list="$parents??[]"
                label="Parent"
            />
        </div>
    </div>

    <x-form.input
        id="comment"
        name="comment"
        label="Описание"
        value="{{old('comment')??@$current->comment}}"
    />

    <x-form.submit
        class="uppercase"
        value="сохранить"
    />

</form>
