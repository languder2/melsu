<div class="p-4 bg-white rounded-md">
    <h3 class="pb-2 font-semibold text  -xl uppercase text-center">
        @if(isset($current->id))
            Внести изменения в карточку отдела
        @else
            Добавить карточки отдела
        @endif
    </h3>

    <x-admin.department.form.content
        :i="0"
        :current="[]"
    />

    <div class="flex">
        <div class="flex-1 pt-4">
            <a href="#" class="
                bg-blue-900
                px-4 py-2
                text-white
                rounded-md
                hover:bg-blue-700
                active:bg-gray-700
                uppercase
            ">
                Добавить секцию
            </a>
        </div>
        <div class="flex-1">
            <x-form.submit
                class="uppercase"
                value="сохранить"
            />
        </div>
    </div>

</div>
