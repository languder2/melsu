@props([
    'filter' => Session::get('cabinetPagesFilters', collect())
])
<form action="{{ route('pages.cabinet.set-filter') }}" method="post"
      class="flex mb-3 gap-3 bg-white p-3"
>
    @csrf

    <x-form.input
        name="search"
        label="Поиск"
        block="flex-2 min-w-1/3"
        value="{!! old('search', $filter->get('search')) !!}"
    />

    <div class="flex gap-3 flex-row-reverse items-center">

        <x-form.submit
            value="Найти"
            class="rounded-sm bg-sky-800"
        />
        <x-form.submit
            value="Сбросить"
            class="bg-red-900 hover:bg-red-700 rounded-sm"
            name="clear"
        />
    </div>
</form>
