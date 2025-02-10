<form
    action="{{route('admin:structure:save')}}"
    method="POST"
    class="
        p-4 bg-white rounded-md
        max-w-[700px]
        mx-auto
    "
>
    @csrf

    <h3 class="pb-2 font-semibold text-xl uppercase text-center">
        @if(isset($form->id))
            Внести изменения
        @else
            Добавить
        @endif
    </h3>

    <hr>

    <x-form.errors/>

    <x-form.input type="hidden" name="id" value="{{$form->id??null}}"/>

    <x-form.select
        id="ssu_group"
        name="ssu_group"
        nullDisabled
        old="{{old('ssu_group')}}"
        value="{{@$form->ssu_group}}"
        null="Выберите группу"
        :list="$groups??[]"
        required
    />

    <x-form.input
        id="department"
        name="department"
        label="Отдел"
        value="{{old('department')??@$form->department}}"
    />

    <x-form.input
        id="post"
        name="post"
        label="Должность"
        value="{{old('post')??@$form->post}}"
    />

    <x-form.input
        id="lastname"
        name="lastname"
        label="Фамилия"
        value="{{old('lastname')??@$form->lastname}}"
    />

    <x-form.input
        id="firstname"
        name="firstname"
        label="Имя"
        value="{{old('firstname')??@$form->firstname}}"
    />

    <x-form.input
        id="middlename"
        name="middlename"
        label="Отчество"
        value="{{old('middlename')??@$form->middlename}}"
    />

    <x-form.input
        id="email"
        name="email"
        label="Email"
        value="{{old('email')??@$form->email}}"
    />

    <x-form.input
        id="phone"
        name="phone"
        type="tel   "
        label="Телефон"
        value="{{old('phone')??@$form->phone}}"
    />

    <x-form.input
        id="address"
        name="address"
        label="Адрес"
        value="{{old('address')??@$form->address}}"
    />

    <x-form.input
        id="sort"
        type="number"
        name="sort"
        label="Порядок сортировки"
        value="{{old('sort')??@$form->sort}}"
    />

    <x-form.input
        id="link"
        name="link"
        label="Link"
        value="{{old('link')??@$form->link}}"
    />

    <x-form.submit
        class="uppercase"
        value="сохранить"
    />

</form>
