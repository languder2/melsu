@props([
    'filter' => \Illuminate\Support\Facades\Session::get('cabinetNewsFilters', collect())
])
<form action="{{ route('news.cabinet.set-filter') }}" method="post"
      class="grid grid-cols-1 lg:grid-cols-3 gap-3 mb-3  bg-white p-3 flex-wrap"
>
    @csrf

    <div class="col-span-3 flex gap-3">
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
    </div>

    <div class="flex items-center">
        <x-form.combobox
            name="author"
            :list="$byFilter->get('authors')"
            :value="$filter->get('author')"
            default="Все авторы"
            block="w-full"
        />
    </div>
    <div class="flex items-center">
        <x-form.combobox
            name="category"
            :list="$byFilter->get('categories')"
            :value="$filter->get('category')"
            default="Все категории"
            block="w-full"
        />
    </div>
    <div class="flex items-center">
        <x-form.combobox
            name="division"
            :list="$byFilter->get('divisions')"
            :value="$filter->get('division')"
            default="Все подразделения"
            block="w-full"
        />
    </div>

</form>
