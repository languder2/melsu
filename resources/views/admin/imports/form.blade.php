<form
    action="{{route('imports:departments:update')}}"
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
        Загрузить файл
    </h3>

    <x-form.errors/>

    <x-form.file
        id="form_file"
        label="File"
        name="file"
    />

    <x-form.submit
        class="uppercase"
        value="Загрузить"
    />

</form>


