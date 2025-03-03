<div
    class="staffBlock"
>
    <input
        type="hidden"
        name="{{$params->name}}"
        class="staffID"
        value="{{$params->value}}"
    >

    <div class="block relative mt-2">
        <input
            type="text"
            @if(isset($params->id))
                id="{{$params->id}}"
            @endif

            name="{{str_replace('staff_id','full_name',$params->name)}}"

            value="{{old('_token') ? $staff->full_name : $staffs[$params->value] ?? null}}"

            autocomplete="off"

            class="
                staffFullName
                border-b
                border-dashed
                bg-none

                outline-0
                w-full
                py-2
                mt-2

                peer
                autofill:text-pink-800
                focus:text-blue-700
                focus:border-blue-700
            {{@$class}}
        "
            onfocus="this.closest('.block').querySelector('ul').classList.remove('hidden')"
            onkeyup="AdminStaff.KeyUp(this)"-
            placeholder=""
        >
        @if(isset($params->label) && isset($params->id))
            <label
                for="{{$params->id}}"
                class="
                absolute
                left-0
                top-0
                text-xs

                duration-200

                peer-focus:text-xs
                peer-focus:top-0
                peer-focus:text-blue-700
                peer-placeholder-shown:top-4
                peer-placeholder-shown:text-base
                peer-autofill:text-xs
                peer-autofill:top-0
            "
            >
                {{$params->label}}
            </label>
        @endif

        <ul
            data-persistent="false"
            class="
                StaffList
                max-h-0 overflow-y-scroll
                peer-focus:max-h-80
                transition-all duration-500
                absolute
                bg-white
                peer-focus:border
                peer-focus:border-dashed
                peer-focus:border-blue-700
                peer-focus:border-t-0
                w-full
                z-50
                hidden
            "
        >
            @foreach($staffs as $staffID=>$full_name)
                <li
                    data-staff-id="{{$staffID}}"
                    data-staff-full-name="{{$full_name}}"
                    class="
                        grid grid-cols-[50px_1fr]
                        px-2 py-1
                        cursor-pointer
                        hover:bg-blue-700
                        hover:text-white
                    "
                    onclick="AdminStaff.selectStaff(this)"
                >
                    <span>
                        {{$staffID}}
                    </span>
                    <span>
                        {{$full_name}}
                    </span>
                </li>
            @endforeach
        </ul>


    </div>
</div>

