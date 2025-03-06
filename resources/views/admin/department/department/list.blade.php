<div class="bg-white rounded-md p-4 mb-4">

    <div
        class="
            grid gap-4 items-center
            grid-cols-1
            md:grid-cols-[auto_3fr_3fr_auto]
        "
    >
        <div class="font-semibold">
            ID
        </div>

        <div class="font-semibold">
            Отдел
        </div>

        <div class="font-semibold">
            Parent
        </div>

        <div></div>

        @foreach($list as $record)

            {{ view('admin.department.department.item',['record'=>$record, "level" => isset($level)?$level+1:0 ]) }}

        @endforeach
    </div>

</div>
