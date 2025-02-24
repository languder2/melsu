<div
    class="
        flex gap-4 bg-stone-50 p-4
        staff-block
    "
>
    <div class="flex-1 relative">

        <x-staff.select
            :params='[
                "name"      => "staffs[$id][staff_id]",
                "label"     => "Сотрудник",
                "id"        => "department_staff_id_$id",
                "value"     => old("staffs.$id.staff_id") ?? $staff ?? null,
            ]'
        />

    </div>

    <div class="flex-1">
        <x-form.input
            id="staffs_{{$id}}_post"
            type="numeric"
            name="staffs[{{$id}}][post]"
            label="Должность"
            value="{{old('staffs.'.$id.'.post')?? $post ?? null}}"
        />
    </div>

    <div class="w-36">
        <x-form.input
            id="staffs_{{$id}}_order"
            type="numeric"
            name="staffs[{{$id}}][order]"
            label="Порядок вывода"
            value="{{old('staffs.'.$id.'.order')?? $order ?? null}}"
        />
    </div>
    <div class="w-8 text-center">
        <a href="{{route('api:department:staff:vacate-position',[$id])}}"
           class="
                inline-block mt-6
                hover:text-red-700
                active:text-gray-700
            "
           onClick="Actions.VacatePosition(this,'.staff-block',true); return false;"
           title="Освободить должность руководителя"
        >
            <i class="fas fa-user-minus"></i>
        </a>

    </div>
</div>




