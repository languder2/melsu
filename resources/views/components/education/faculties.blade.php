@foreach($list as $faculty)
    <div
        class="
            border
            mb-4
            p-4
        "
    >
        <h3 class="text-xl border-b mb-2 pb-2 font-semibold">
            {{$faculty->name}}
        </h3>
        <div class="grid grid-cols-[1fr_50px_1fr_50px] gap-2">
            <div class="p-2">
                Кол-во кафедр
            </div>
            <div class="p-2 text-lg text-baseRed font-semibold">
                <a
                    href="{{url("faculties/{$faculty->code}/departments")}}"
                    class="hover:underline"
                >
                    {{$faculty->departments->count()}}
                </a>
            </div>
            <div class="p-2">
                Программ подготовки
            </div>
            <div class="p-2 text-lg text-baseRed font-semibold">
                <a
                    href="{{url("faculties/{$faculty->code}/specialities")}}"
                    class="hover:underline">
                    {{$faculty->specialities->count()}}
                </a>
            </div>
        </div>
        <hr class="mb-3">
        <div>
            {{$faculty->description}}
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aut beatae dolores, doloribus ducimus
            earum eveniet laudantium magnam numquam odio perspiciatis placeat porro praesentium, quas tempore veniam
            vero. Eveniet, explicabo? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur cumque enim
            incidunt, laborum minima odio perferendis quia quis tempora veniam. Alias autem blanditiis dolor et nam
            optio quidem quo voluptas?
        </div>
        <div class="text-right">
            <a
                href="{{url("faculties/{$faculty->code}")}}"
                class="hover:text-baseRed hover:underline">
                подробнее...
            </a>
        </div>

    </div>

@endforeach
