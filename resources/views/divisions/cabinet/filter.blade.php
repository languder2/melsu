@props([
    'filter' => Session::get('divisionCabinetFilter') ?? collect()
])
<form action="{{ route('divisions.cabinet.set-filter') }}" method="post" class="mb-3">
    @csrf

    <div class="flex gap-3 items-end">

        <x-form.input
            name="search"
            label="Поиск"
            block="flex-1"
            value="{!! old('search', $filter->get('search')) !!}"
        />

        <div class="flex gap-3 flex-row-reverse">

            <x-form.submit
                value="Найти"
            />
            <x-form.submit
                value="Сбросить"
                class="bg-red-900 hover:bg-red-700"
                name="clear"
            />
        </div>

    </div>

</form>
