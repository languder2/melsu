<section
    class="bg-white p-4 flex gap-4 staff-block"
>
    <div class="flex-1">

        Сотрудник<br>
        должность<br>
        должность с учетом подразделения<br>
        вывести/скрыть<br>

        <x-form.input
            id="form_sort"
            name="sort"
            label="Порядок вывода"
            value="{{ old('_token') ? old('sort') : $staff->sort ?? null }}"
        />
        <x-form.input
            id="form_sort"
            name="sort"
            label="Порядок вывода"
            value="{{ old('_token') ? old('sort') : $staff->sort ?? null }}"
        />

        <div class="flex gap-4 items-end">
            <div class="flex-1">
                <x-form.input
                    id="form_sort"
                    name="sort"
                    type="number"
                    step="1"
                    label="Порядок вывода"
                    value="{{ old('_token') ? old('sort') : $staff->sort ?? null }}"
                />
            </div>

            <x-form.radio.on-off-alt
                name="is_show"
                block="pb-2"
            />
        </div>

    </div>
    <div>
        <a
            href="https://melsu/api/divisions/vacate-position/917"
            class="
                inline-block
                hover:text-red-700
                active:text-gray-700
            "
            onclick="Actions.VacatePosition(this,'.chief-block'); return false;"
            title="Освободить должность руководителя"

        >
            <i class="fas fa-user-times"></i>
        </a>

    </div>

</section>

