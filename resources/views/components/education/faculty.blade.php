<div
    class="
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
        {!! $faculty->description !!}
    </div>

</div>
