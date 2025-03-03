<div
    class="
        bg-stone-50 p-4
        chief-block
    "
>
    <div class="grid gap-4 grid-cols-[1fr_auto]">
        <div class="relative">
            <x-staff.select
                :params='[
                        "name"      => "chief[staff_id]",
                        "label"     => "Руководитель",
                        "id"        => "form_department_chief",
                        "value"     => $current->id ?? null,
                    ]'
                :staff="old('chief')"
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

    <div class="grid gap-4 grid-cols-[1fr_3fr]">
        <div>
            <x-form.input
                id="chief_post"
                name="chief[post]"
                label="Должность"
                value="{{old('chief.post')?? $post ?? null}}"
            />
        </div>

        <div>
            <x-form.input
                id="chief_post_alt"
                name="chief[post_alt]"
                label="Должность полностью"
                value="{{old('chief.post_alt')?? $alt ?? null}}"
            />
        </div>
    </div>
</div>
