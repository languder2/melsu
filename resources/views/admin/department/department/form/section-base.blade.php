<div
    id="tab_department_base"
    @class([
        "department_form_box",
        (!old('_token') || old('side_menu') === 'tab_department_base')?'':'hidden'
    ])
>
    <div class="bg-stone-50 p-4 flex gap-4 mb-4">
        <div class="flex-1 text-lg font-semibold">
            Базовые параметры
        </div>
    </div>


    <div class="bg-stone-50 p-4 mb-4">

        <x-form.input
            id="form_department_name"
            name="name"
            label="Название"
            value="{{old('name') ?? $current->name ?? null}}"
            required
        />

        <x-form.select
            id="form_department_parent_id"
            name="parent_id"
            old="{{old('parent_id') ?? $addTo ?? null}}"
            value="{{$current->parent_id ?? null}}"
            null="Выбрать"
            :list="$parents??[]"
            label="Parent"
        />

        <x-staff.select
            :current="$current->coordinator_id ?? null"
            :params='[
                "name"      => "coordinator[staff_id]",
                "label"     => "Координатор",
                "id"        => "form_department_coordinator_id",
                "value"     => old("coordinator.staff_id") ?? $current->coordinator_id ?? null,
            ]'
            :staff="old('coordinator')"

        />

        <div class="flex gap-4 my-2">
            @if($current)
                <img src="{{$current->preview->thumbnail}}" alt="123" class="h-44 rounded-md">
            @endif

            <div class="flex-1">
                <div class="block md:flex flex-row gap-4 items-center">
                    <div class="flex-1">
                        <x-form.input
                            id="form_department_code"
                            name="code"
                            label="Alias"
                            value="{{ old('code') ?? optional($current)->code }}"
                        />
                    </div>
                    <span class="w-full md:w-40">
                        <x-form.input
                            id="form_department_order"
                            name="order"
                            type="number"
                            label="Порядок вывода"
                            class="text-center"
                            value="{{old('order')??optional($current)->order}}"
                        />
                    </span>

                    <x-form.on-off
                        :old="old('show')"
                        :current="$current"
                    />
                </div>

                <x-form.file
                    id="form_department_image"
                    label="Превью"
                    name="image"
                />

                <x-form.input
                    id="form_department_preview"
                    name="preview"
                    label="Превью из галереи"
                    value="{{old('preview') ?? $current->preview->src ?? null}}"
                />

            </div>
        </div>
    </div>
</div>
