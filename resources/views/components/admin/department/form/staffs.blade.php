<div class="p-4 bg-white rounded-md mb-4">

    <h4 class="font-semibold pb-2 text-xl uppercase text-center">
        Начальник
    </h4>

    <hr class="my-2"/>

    <x-admin.department.form.select-chief
        keyID="id"
        field="fio"
        :list="$staffs??[]"
        placeholder="Выбрать начальника"
        :current="$current"
    />

    <hr class="my-2"/>

    <h4 class="font-semibold pb-2 text-xl uppercase text-center">
        Список сотрудников
    </h4>

    <hr class="my-2"/>

    <div id="staff-list">
        @if(!empty(old('staffs')))
            @foreach(old('staffs') as $key=>$record)
                <x-admin.department.form.select-staff
                    :i="$key"
                    keyID="id"
                    field="fio"
                    :list="$staffs??[]"
                    placeholder="Выбрать сотрудника"
                />
            @endforeach
        @elseif(!empty($current->staffs))
            @foreach($current->staffs as $staff)
                <x-admin.department.form.select-staff
                    :i="$staff->id"
                    keyID="id"
                    field="fio"
                    :list="$staffs??[]"
                    placeholder="Выбрать сотрудника"
                    :current="$staff"
                />
            @endforeach
        @else
            <x-admin.department.form.select-staff
                :i="now()->timestamp"
                keyID="id"
                field="fio"
                :list="$staffs??[]"
                placeholder="Выбрать сотрудника"
            />
        @endif
    </div>

    <div class="text-center">
        <a
            href="{{route('admin:department:staff:add')}}"
            class="
                py-2 px-4
                rounded-md
                text-white
                bg-blue-950 hover:bg-blue-700 active:bg-gray-700
            "
            onclick="return AddLine.addLine(this.href,'staff-list',SearchSelect.callAddSelect,'SelectWrapper');"
        >
            <i class="fas fa-plus w-4 py-2"></i>
            Добавить сотрудника
        </a>
    </div>
</div>


