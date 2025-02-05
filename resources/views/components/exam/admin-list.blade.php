123
<div class="grid grid-cols-[1fr_60px_60px_60px] gap-x-2 gap-y-2 items-center">
    <div class="font-semibold">
        Предмет
    </div>
    <div class="text-center font-semibold">
        Выбор
    </div>
    <div class="text-center font-semibold">
        Обяз.
    </div>
    <div class="text-center font-semibold">
        Баллов
    </div>
    @foreach($AcademicSubjects??[] as $as_code=>$as)
        <div>
            {{$as}}
        </div>
        <div class="text-center">

            <input
                type="checkbox"
                class="w-6 h-6 cursor-pointer"
                name="profiles[{{$code}}][exams][{{$type}}][{{$as_code}}][selectable]"
                value="1"
                @checked(
                    old("speciality.name")
                        ?old("profiles.{$code}.exams.{$type}.{$as_code}.selectable")
                        :@$exams[$as_code]?->selectable
                )
            >
        </div>
        <div class="text-center">
            <input
                type="checkbox"
                class="w-6 h-6 cursor-pointer"
                name="profiles[{{$code}}][exams][{{$type}}][{{$as_code}}][required]"
                value="1"
                @checked(
                    old("speciality.name")
                        ?old("profiles.{$code}.exams.{$type}.{$as_code}.required")
                        :@$exams[$as_code]?->required
                )
            >
        </div>
        <div class="text-center">
            <input
                type="number"
                name="profiles[{{$code}}][exams][{{$type}}][{{$as_code}}][score]"
                min="0"
                max="100"
                class="
                    w-full
                    border-b
                    border-dashed
                    text-center
                    outline-0
                "
                value="{{
                        old("speciality.name")
                        ?old("profiles.{$code}.exams.{$type}.{$as_code}.score")
                        :@$exams[$as_code]?->score

                }}"
            >
        </div>
    @endforeach
</div>
