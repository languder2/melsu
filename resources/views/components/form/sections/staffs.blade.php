<div
    id="tab_staffs"
    @class([
        "form_box",
        (old('side_menu') === 'tab_staffs')?'':'hidden'
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


        @component('staff.admin.select',[
            'with_out_sort' => true
        ]) @endcomponent



    @component('components.staff.select-chief',[
            'id'        => $current?->chief?->id ?? null,
            'chief'     => $current?->chief?->staff_id ?? null ,
            'post'      => $current?->chief?->post ?? null,
            'alt'       => $current?->chief?->post_alt ?? null,
            'name'      => "chief",
            "old"       => old('chief')
        ])

    @endcomponent




{{--        @if(old('_token'))--}}
{{--            @foreach(old('staffs') as $staff_id => $staff)--}}
{{--                <x-staff.select-with-post--}}
{{--                    :id="$staff_id"--}}
{{--                />--}}
{{--            @endforeach--}}
{{--        @elseif($current->staffs ?? null)--}}
{{--            @foreach($current->staffs as $staff)--}}
{{--                <x-staff.select-with-post--}}
{{--                    :id="$staff->id"--}}
{{--                    :staff='$staff->staff_id'--}}
{{--                    :post='$staff->post'--}}
{{--                    :alt='$staff->post_alt'--}}
{{--                    :order='$staff->order'--}}
{{--                />--}}
{{--            @endforeach--}}
{{--        @endif--}}

{{--        @if(!old('_token') && (!$current || $current->staffs->count()===0))--}}
{{--            <x-staff.select-with-post--}}
{{--                :id="(int)microtime(true)"--}}
{{--            />--}}
{{--        @endif--}}
    </div>
</div>
