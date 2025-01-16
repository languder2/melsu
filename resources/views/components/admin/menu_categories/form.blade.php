<form
    action="{{route('admin:menu-categories:save')}}"
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

    <x-form.errors />

    <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>


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
