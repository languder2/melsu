<h3 class="text-2xl font-semibold mb-4 my-6">
    {{$department->name}}
</h3>
<div class="bg-white rounded-md p-4 mb-4">

    <div class="grid grid-cols-1 md:grid-cols-7 gap-x-4 gap-y-4">
        <div class="font-semibold">
            Отдел
        </div>

        <div class="font-semibold">
            Должность
        </div>

        <div class="font-semibold">
            ФИО
        </div>

        <div class="font-semibold">
            Адрес
        </div>

        <div class="font-semibold">
            Email
        </div>

        <div class="font-semibold">
            Телефон
        </div>

        <div></div>

        @foreach($department->list as $record)
            <div>
                    <?= $record->department ?>
            </div>

            <div>
                    <?= $record->post ?>
            </div>

            <div>
                    <?= $record->lastname ?>
                    <?= $record->firstname ?>
                    <?= $record->middlename ?>
            </div>

            <div>
                    <?= $record->address ?>
            </div>

            <div>
                    <?= $record->email ?>
            </div>

            <div>
                    <?= $record->phone ?>
            </div>

            <div>
                <div class="flex flex-row-reverse text-white">
                    <div class="flex-none w-14">
                        <a
                            href="{{route('admin:structure:delete',$record->id)}}"
                            class="
                                py-2 px-4 rounded-md
                                bg-red-950
                                hover:bg-red-700
                                active:bg-gray-700
                            "
                        >
                            <i class="fas fa-user-slash w-4 h-4"></i>
                        </a>
                    </div>
                    <div class="flex-none w-14">
                        <a
                            href="{{route('admin:structure:edit',$record->id)}}"
                            class="
                                py-2 px-4 rounded-md
                                bg-green-950
                                hover:bg-green-700
                                active:bg-gray-700
                            "
                        >
                            <i class="far fa-edit w-4 h-4"></i>
                        </a>
                    </div>

                    @if(!empty($record->link))
                        <div class="flex-none w-14">
                            <a
                                href="{{$record->link??'#'}}"
                                target="_blank"
                                class="
                                    py-2 px-4 rounded-md
                                    bg-blue-950
                                    hover:bg-blue-700
                                    active:bg-gray-700
                                "
                            >
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <hr class="md:col-span-7 last:hidden">
        @endforeach
    </div>

</div>
