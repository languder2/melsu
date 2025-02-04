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
    @foreach($AcademicSubjects as $as_code=>$as)
        <div>
            {{$as}}
        </div>
        <div class="text-center">
            <input
                type="checkbox"
                class="w-6 h-6 cursor-pointer"
                name="profiles[{{$code}}][{{$type}}][exams][{{$as_code}}][selected]"
                value="selected"
                @checked(old("profiles.{$code}.{$type}.exams.{$as_code}.selected"))
            >
        </div>
        <div class="text-center">
            <input
                type="checkbox"
                class="w-6 h-6 cursor-pointer"
                name="profiles[{{$code}}][{{$type}}][exams][{{$as_code}}][required]"
                value="required"
                @checked(old("profiles.{$code}.{$type}.exams.{$as_code}.required"))
            >
        </div>
        <div class="text-center">
            <input
                type="number"
                name="profiles[{{$code}}][{{$type}}][exams][{{$as_code}}][scores]"
                min="0"
                max="100"
                class="
                    w-full
                    border-b
                    border-dashed
                    text-center
                    outline-0

                "
                value="{{old("profiles.{$code}.{$type}.exams.{$as_code}.scores")}}"
            >
        </div>
    @endforeach
</div>

