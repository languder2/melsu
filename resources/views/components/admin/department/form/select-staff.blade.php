<div class="flex mb-4 gap-x-4" id="SelectWrapper{{$i}}">
    <div class="select-wrapper border-b border-dashed flex-1 relative">

        <x-form.input
            name="staffs[{{$i}}][staff]"
            type="hidden"
            class="input-hidden"
            value="{{old('staffs.'.$i.'.staff')??@$current->staff}}"
        />

        <input
            class="
            chosen-value
            relative
            top-0 left-0
            outline-0 z-20
            w-full
            py-2
            transition duration-300 ease-in-out
            placeholder:text-[black]
            focus:border-b-[2px]
            bg-white
            h-12
        "
            name="staffs[{{$i}}][staff_name]"

            value=
                "@if(!empty(old('staffs.'.$i.'.staff_name')))
                    {{old('staffs.'.$i.'.staff_name')}}
                @elseif(!empty($current)){{$current->lastname}} {{$current->firstname}} {{$current->middle_name}}@endif"


            type="text"
            placeholder="{{@$placeholder}}"
            data-placeholder="{{@$placeholder}}"
        >
        <ul
            class="
            value-list
            transition duration-300 ease-in-out
            absolute top-0 left-0
            w-full max-h-0
            cursor-pointer
            list-none
            mt-12
            shadow-[2px_24px_17px_-13px_rgba(66, 68, 90, 1)]
            overflow-hidden
            [&.open]:max-h-[320px]
            [&.open]:overflow-auto
            [&.open]:border-2
            z-30

        "
        >
            @foreach($list as $key=>$record)
                <li
                    data-id="{!! @$record->{$keyID} !!}"
                    class="

                    drop-li
                    min-h-[4rem]
                    opacity-1
                    relative
                    p-[1rem]
                    bg-white
                    opacity-100
                    flex
                    items-center
                    cursor-pointer
                    transition duration-300 ease-in-out
                    max-h-0
                    hover:bg-[#820000]
                    hover:text-white
                    [&.closed]:max-h-0
                    [&.closed]:overflow-hidden
                    [&.closed]:p-0
                    [&.closed]:opacity-0
                    [&.closed]:min-h-[0px]
                "
                >{!! @$record->{$field} !!}</li>

            @endforeach
        </ul>
    </div>
    <div class="flex-1 min-w-60">
        <x-form.input
            id="staffs_{{$i}}_post"
            type="numeric"
            name="staffs[{{$i}}][post]"
            label="Должность"
            value="{{old('staffs.'.$i.'.post')??@$current->post}}"
        />
    </div>

    <div class="min-w-36">
        <x-form.input
            id="staffs_{{$i}}_sort"
            type="numeric"
            name="staffs[{{$i}}][sort]"
            label="Sort"
            value="{{old('staffs.'.$i.'.sort')??@$current->sort}}"
        />
    </div>
    <div class="w-8 text-center">
        <a href="#"
           class="
                inline-block mt-6
                hover:text-red-700
                active:text-gray-700
            "
           onClick="return AddLine.RemoveBLock('SelectWrapper{{$i}}');"
        >
            <i class="fas fa-user-minus"></i>
        </a>
    </div>
</div>
