<div
    @class(['wrapper mb-2'])
>

    <label class="text-xs">
        Соответствие учебному подразделению
    </label>

    <select
        class="w-full pb-2 border-b border-dashed outline-0"
        name="identity"

    >
        <option value>
            Нет привязки
        </option>


        <optgroup label="Факультеты" data-type="faculty_id">
            @foreach($faculties as $id=>$value)
                <option value="faculty:{{$id}}" @selected($current === "faculty:$id")>
                    {{$value}}
                </option>
            @endforeach
        </optgroup>

        <optgroup label="Кафедры" data-type="department_id" class="px-4 py-6">
            @foreach($departments as $id=>$value)
                <option value="department:{{$id}}" @selected($current === "department:$id")>
                    {{$value}}
                </option>
            @endforeach
        </optgroup>

        <optgroup label="Лаборатории" data-type="lab_id" class="px-4 py-6">
            @foreach($labs as $id=>$value)
                <option value="lab:{{$id}}" @selected($current === "lab:$id")>
                    {{$value}}
                </option>
            @endforeach
        </optgroup>
    </select>
</div>

