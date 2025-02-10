<div class="flex gap-8">
    <div class="select-wrapper relative flex-1">

        <x-form.input
            name="chief"
            type="hidden"
            class="input-hidden"
            value="{{old('chief')??@$current->chief}}"
        />

        <input
            class="
                border-b border-dashed
                chosen-value
                relative
                top-0 left-0
                outline-0 z-20
                w-full
                py-4
                transition duration-300 ease-in-out
                placeholder:text-[black]
                focus:border-b-[2px]
                bg-white
                h-12
            "
            type="text"
            name="chief_name"
            value="{{old('chief_name')??@$current->chief_name}}"
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
                        hover:bg-red-700
                        hover:text-white
                        [&.closed]:bg-red-700
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
    <div class="flex-1">
        <x-form.input
            id="chief_post"
            name="chief_post"
            label="Должность"
            value="{{old('chief_post')??@$current->chief_post}}"
        />
    </div>
</div>
