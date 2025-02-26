<div
    id="tab_department_staffs"
    @class([
        "department_form_box",
        (old('side_menu') === 'tab_department_staffs')?'':'hidden'
    ])
>

    <div class="bg-stone-50 p-4 flex gap-4 mb-4">
        <div class="flex-1 text-lg font-semibold">
            Сотрудники
        </div>
        <div class="w-8 text-center">
            <a href="{{route('api:department:staff:add-position')}}"
               class="
                inline-block mt-2
                hover:text-green-700
                active:text-gray-700
            "
               onClick="Actions.addStaffPosition(this,'staffs'); return false;"
               title="Добавить позицию сотрудника"
            >
                <i class="fas fa-user-plus"></i>
            </a>

        </div>

    </div>

    <div id="staffs" class="flex flex-col gap-4 mb-4">

        <x-staff.select-chief
            :id='$current?->chief?->id ?? null '
            :chief='$current?->chief?->staff_id ?? null '
            :post="$current?->chief?->post ?? null "
            :post_alt="$current?->chief?->post_alt ?? null "
            name="chief"
            :old="old('chief')"
        />


        @if(old('_token'))
            @foreach(old('staffs') as $staff_id => $staff)
                <x-staff.select-with-post
                    :id="$staff_id"
                />
            @endforeach
        @elseif($current->staffs)
            @foreach($current->staffs as $staff)
                <x-staff.select-with-post
                    :id="$staff->id"
                    :staff='$staff->staff_id'
                    :post='$staff->post'
                    :post_alt='$staff->post_alt'
                    :order='$staff->order'
                />
            @endforeach
        @endif

        @unless($current->staffs || old('_token'))
            <x-staff.select-with-post
                :id="(int)microtime(true)"
            />
        @endunless

        @if(!old('_token') && $current->staffs->count()===0)
            <x-staff.select-with-post
                :id="(int)microtime(true)"
            />
        @endif
    </div>

</div>
