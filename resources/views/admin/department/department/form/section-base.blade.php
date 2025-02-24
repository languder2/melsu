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
            value="{{old('name')??@$current->name}}"
            required
        />

        <x-form.select
            id="form_department_parent_id"
            name="parent_id"
            old="{{old('parent_id')?? $addTo ?? null}}"
            value="{{optional($current)->parent_id}}"
            null="Выбрать"
            :list="$parents??[]"
            label="Parent"
        />

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-form.select
                    id="form_department_group_id"
                    name="group_id"
                    old="{{old('group_id')?? $group ?? null}}"
                    value="{{optional($current)->group_id}}"
                    null="Выбрать"
                    :list="$groups??[]"
                    label="Группа"
                />
            </div>

            <div class="pt-3">
                <x-staff.select
                    :current="optional($current)->coordinator_id"
                    :params='[
                        "name"      => "coordinator_id",
                        "label"     => "Координатор",
                        "id"        => "form_department_coordinator_id",
                        "value"     => old("coordinator_id") ?? optional($current)->coordinator_id,
                    ]'
                />
            </div>
        </div>

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
                    value="{{old('preview')??optional(optional($current)->preview)->src}}"
                />

            </div>
        </div>
    </div>
</div>

