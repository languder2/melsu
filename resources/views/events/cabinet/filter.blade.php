@props([
    'filter' => \Illuminate\Support\Facades\Session::get('cabinetNewsFilters', collect())
])
<form action="{{ route('news.cabinet.set-filter') }}" method="post"
      class="flex mb-3 gap-3 bg-white p-3"
>
    @csrf

    <x-form.input
        name="search"
        label="Поиск"
        block="flex-2 min-w-1/3"
        value="{!! old('search', $filter->get('search')) !!}"
    />

    <x-form.select2
        id="form_division"
        name="author"
        value="{{ $filter->get('author') }}"
        null="Выбрать автора"
        class="flex-1"
        :list=" $byFilter->get('authors') ?? [] "
    />

    <x-form.select2
        id="form_division"
        name="division"
        value="{{ $filter->get('division') }}"
        null="Выбрать подразделение"
        class="flex-1"
        :list=" $byFilter->get('divisions') "
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
