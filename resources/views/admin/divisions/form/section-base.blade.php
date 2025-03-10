<div
    id="tab_division_base"
    @class([
        "division_form_box",
        (!old('_token') || old('side_menu') === 'tab_division_base')?'':'hidden'
    ])
>
    <div class="bg-stone-50 p-4 flex gap-4 mb-4">
        <div class="flex-1 text-lg font-semibold">
            Базовые параметры
        </div>
    </div>

    <div class="bg-stone-50 p-4 mb-4">

        <x-form.select
            id="form_division_parent_id"
            name="parent_id"
            old="{{old('parent_id') ?? $addTo ?? null}}"
            value="{{$current->parent_id ?? null}}"
            null="Выбрать"
            :list="$parents??[]"
            label="Parent"
        />

        <x-form.input
            id="form_division_name"
            name="name"
            label="Название"
            value="{{old('name') ?? $current->name ?? null}}"
            required
        />

        <x-admin.education.select.opt-group
            :current="$current->identity ?? null"
        />

        <x-staff.select
            :current="$current->coordinator_id ?? null"
            :params='[
                "name"      => "coordinator[staff_id]",
                "label"     => "Координатор",
                "id"        => "form_division_coordinator_id",
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
                            id="form_division_code"
                            name="code"
                            label="Alias"
                            value="{{ old('code') ?? optional($current)->code }}"
                        />
                    </div>
                    <span class="w-full md:w-40">
                        <x-form.input
                            id="form_division_order"
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
                    id="form_division_image"
                    label="Превью"
                    name="image"
                />

                <x-form.input
                    id="form_division_preview"
                    name="preview"
                    label="Превью из галереи"
                    value="{{old('preview') ?? $current->preview->src ?? null}}"
                />

            </div>
        </div>
    </div>
</div>
