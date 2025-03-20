<div class="bg-white rounded-md p-4 mb-4">

    <div
        class="
            grid gap-4 items-center
            grid-cols-1
            md:grid-cols-[auto_auto_auto_auto_auto_1fr_auto]
        "
    >
        <div class="font-semibold">
            ID
        </div>

        <div>
        </div>

        <div class="font-semibold">
            Код
        </div>

        <div class="font-semibold">
            Название
        </div>

        <div class="font-semibold">
            Ico
        </div>

        <div class="font-semibold">
            Parent
        </div>

        <div></div>

        @foreach($list as $record)

            {{ view('admin.menu.menu.item',['record'=>$record, "level" => isset($level)?$level+1:0 ]) }}

        @endforeach
    </div>

</div>
