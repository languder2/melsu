<div
    id="tab_division_staffs"
    @class([
        "division_form_box",
        (old('side_menu') === 'tab_division_staffs')?'':'hidden'
    ])
>

    <div class="bg-stone-50 p-4 flex gap-4 mb-4">
        <div class="flex-1 text-lg font-semibold">
            Сотрудники
        </div>
        <div class="w-8 text-center">
            <a href="{{route('api:division:staff:add-position')}}"
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
            :id='$current->chief?->card?->id ?? null'
            :current="$current->chief?->card ?? null"
            :post="$current->chief?->post ?? null"
            :alt="$current->chief?->post_alt ?? null"
        />


        @if(old('_token') && is_array(old('staffs')))
            @foreach(old('staffs') as $staff_id => $staff)
                <x-staff.select-with-post
                    :id="$staff_id"
                    :staff="$staff['full_name']"
                    :post="$staff['post']"
                    :alt="$staff['post_alt']"
                    :order="$staff['order']"
                />
            @endforeach
        @elseif($current)
            @foreach($current->staffs as $staff)
                <x-staff.select-with-post
                    :id="$staff->id"
                    :staff='$staff->staff_id'
                    :post='$staff->post'
                    :alt='$staff->post_alt'
                    :order='$staff->order'
                />
            @endforeach
        @endif

    </div>

</div>
