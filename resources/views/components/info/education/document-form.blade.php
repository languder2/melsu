<form action="{{ $save }}"
      method="POST"
      enctype="multipart/form-data"
      class="p-4 pt-0 flex flex-col gap-2"
>
    @csrf

    <input type="hidden" name="optional[code]" value="{{ $code }}">

    <x-form.input
        id="title"
        name="title"
        label="Название файла"
        value=""
        required
    />


    <x-form.file
        id="file"
        label="Document"
        name="file"
    />

    <div class="flex gap-4">

        <x-form.select2
            id="type"
            name="optional[type]"
            value=""
            null="Тип"
            :list="$types"
        />

        <x-form.select2
            id="type"
            name="optional[year]"
            value=""
            null="Год"
            :list="$years"
        />
    </div>

    <x-form.input
        id="form-sort"
        type="number"
        name="sort"
        label="Порядок вывода"
        value=""
    />

    @component('components.form.submit',[
        'name'          => 'save',
        'class'         => "uppercase",
        'value'         => "сохранить",
        'position'      => "text-center",
    ])@endcomponent

</form>
