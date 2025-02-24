<div
    class="
        flex gap-4 bg-stone-50 p-4
        chief-block
    "
>
    <div class="flex-1 relative">

        <x-staff.select
            :params='[
                    "name"      => "chief",
                    "label"     => "Руководитель",
                    "id"        => "form_department_chief",
                    "value"     => $old ?? $chief ?? null,
                ]'
        />
    </div>

    <div class="flex-1">
        <x-form.input
            id="chief_post"
            type="numeric"
            name="chief_post"
            label="Должность"
            value="{{old('$chief_post')?? $post ?? null}}"
        />
    </div>

    <div class="w-8 text-center">
        <a href="{{route('api:department:staff:vacate-position',[$id])}}"
           class="
                inline-block mt-6
                hover:text-red-700
                active:text-gray-700
            "
           onClick="Actions.VacatePosition(this,'.chief-block'); return false;"
           title="Освободить должность руководителя"
        >
            <i class="fas fa-user-times"></i>
        </a>
    </div>
</div>

