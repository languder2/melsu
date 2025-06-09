<form class="flex gap-4" action="{{ $route ?? null }}" method="POST">
    @csrf

    <div class="flex-1 flex flex-col gap-4">
        <x-form.input
            id="filter-search"
            name="search"
            label="Поиск"
            value="{{ $filters['search'] ?? null }}"
        />

        <div class="flex gap-4">
            <div class="flex-auto">
                <x-form.select
                    id="filter_level"
                    name="level"
                    value="{{ $filters['level'] ?? null }}"
                    null="все"
                    label="Уровень"
                    :list="$levels ?? []"
                />
            </div>

            <div class="flex-auto">
                <x-form.select
                    id="filter_is_show"
                    name="is_show"
                    value="{{ $filters['is_show'] ?? null }}"
                    null="все"
                    label="Активность"
                    :list="$is_show_list ?? []"
                />
            </div>

            <div class="flex-1">
                <x-form.select2
                    id="filter_institute"
                    name="institute"
                    value="{{ $filters['institute'] ?? null }}"
                    null="все"
                    label="Институт"
                    :list="$institutes ?? []"
                />
            </div>

            <div class="flex-1">
                <x-form.select2
                    id="filter_faculty"
                    name="faculty"
                    value="{{ $filters['faculty'] ?? null }}"
                    null="все"
                    label="Факультет"
                    :list="$faculties ?? []"
                />
            </div>

            <div class="flex-1">
                <x-form.select2
                    id="filter_department"
                    name="department"
                    value="{{ $filters['department'] ?? null }}"
                    null="все"
                    label="Кафедра"
                    :list="$departments ?? []"
                />
            </div>

            <div class="flex-1">
                <x-form.select2
                    id="filter_branch"
                    name="branch"
                    value="{{ $filters['branch'] ?? null }}"
                    null="все"
                    label="Филиал"
                    :list="$branches ?? []"
                />
            </div>

        </div>
    </div>

    <div class="flex flex-col justify-around">
        <div>
            @component('components.form.submit',[
                'name'          => 'show',
                'class'         => "uppercase w-full",
                'value'         => "Найти",
            ])@endcomponent
        </div>
        <div>
            @component('components.form.submit',[
                'name'          => 'clear',
                'class'         => "bg-red hover:bg-red-700",
                'value'         => "Сбросить",
            ])@endcomponent
        </div>

    </div>
</form>
