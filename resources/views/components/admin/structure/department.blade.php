<div class="bg-white rounded-md p-4 mb-4">
    <h3 class="text-2xl font-semibold mb-4">
        {{$department->name}}
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-7 gap-x-4 gap-y-4">
        @foreach($department->list as $record)
            <div>
                <?=$record->department?>
            </div>

            <div>
                <?=$record->post?>
            </div>

            <div>
                <?=$record->fio?>
            </div>

            <div>
                <?=$record->address?>
            </div>

            <div>
                <?=$record->email?>
            </div>

            <div>
                <?=$record->phone?>
            </div>

            <div>
                <div class="flex flex-row-reverse text-white">
                    <div class="flex-none w-14">
                        <a href="#" class="bg-green-950 py-2 px-4">
                            <i class="far fa-edit w-4 h-4"></i>
                        </a>
                    </div>
                    <div class="flex-none w-14">
                        <a href="#" class="bg-red-950 py-2 px-4 ">
                            <i class="fas fa-user-slash w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="md:col-span-7 last:hidden">
        @endforeach
    </div>

</div>
