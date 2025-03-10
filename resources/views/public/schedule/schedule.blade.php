@extends("layouts.main")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')

<?php function getWeekNumberFromSeptember($date) {

$dateTime = new DateTime($date);

$startDateTime = new DateTime('2024-09-01');

$diff = $dateTime->diff($startDateTime);

$weekNumber = (int) floor(($diff->days + $startDateTime->format('w')) / 7) + 1;

return $weekNumber;
}
?>

@section('content')
    <section class="p-2.5">
    <div class="border-2 border-red-900 p-6 ">
        <form action="{{ route('public.schedule.updateSchedule') }}" method="POST" class="grid grid-cols-1 xl:grid-cols-6 gap-2">
            @csrf
            <div>
                <select id="week" name="week" class="bg-white p-2.5 appearance-none border border-red-900 xl:max-w-50 w-full">
                    @php
                        $today = date('Y-m-d');
                        $currentWeekNumber = getWeekNumberFromSeptember($today);
                    @endphp
                    @foreach ($weeks as $week)
                        @if($week == $currentWeekNumber)
                            <option selected value="{{ $week }}">Текущая неделя</option>
                        @elseif($week >= 20 && $week <= 23)
                            <option value="{{ $week }}">{{ $week }} - Экзаменационная неделя</option>
                        @else
                            <option value="{{ $week }}">{{ $week }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <select id="faculty" class="bg-white p-2.5 appearance-none border border-red-900 xl:max-w-50 w-full" name="faculty">
                    <option value="">Факультет</option>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty }}">{{ $faculty }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select id="form_edu" name="form_edu" class="bg-white p-2.5 appearance-none border border-red-900 xl:max-w-50 w-full" required>
                    <option value="">Форма обучения</option>
                    @foreach ($forms_edu as $form)
                        <option value="{{ $form }}">
                            @if($form == 1) Очная @endif
                            @if($form == 2) Очно-заочная @endif
                            @if($form == 3) Заочная @endif
                        </option>
                    @endforeach
                </select>
            </div>
                <div>
                    <select id="course" name="course" class="bg-white p-2.5 appearance-none border border-red-900 xl:max-w-50 w-full" required>
                        <option value="">Курс</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course }}">
                                @if($course == 6) М1 @else {{ $course }} @endif
                            </option>
                        @endforeach
                    </select>
                </div>
            <div class="select-wrapper relative">
                <input type="text" class="input-hidden hidden">
                <input name="group" class="chosen-value relative top-0 left-0 bg-white p-2.5 appearance-none border border-red-900 xl:max-w-50 w-full
                             transition duration-300 ease-in-out placeholder:text-[black] outline-0 z-20"
                       type="text" value="" placeholder="Группа">
                <ul id="groupList" class="value-list transition duration-300 ease-in-out absolute top-0 left-0 w-full max-h-0 cursor-pointer list-none mt-[48px] shadow-[2px_24px_17px_-13px_rgba(66, 68, 90, 1)] overflow-hidden
                [&.open]:max-h-[320px] [&.open]:overflow-auto z-20">
                    @foreach ($groups as $group)
                    <li data-id="1" class="drop-li min-h-[4rem] opacity-100 relative p-[1rem] bg-white text-lg flex items-center cursor-pointer transition duration-300 ease-in-out max-h-0 hover:bg-[#820000] hover:text-white
                                [&.closed]:max-h-0 [&.closed]:overflow-hidden [&.closed]:p-0 [&.closed]:opacity-0 [&.closed]:min-h-[0px]">
                        {{$group }}
                    </li>
                    @endforeach>
                </ul>
            </div>
            <button type="submit" class="p-2.5 appearance-none border border-red-900 xl:max-w-50 w-full transition duration-300 ease-linear hover:bg-red-900 hover:text-white cursor-pointer">Применить</button>
        </form>
    </div>
    @if($schedule == 'start')
        <div class="empty_search text-center mt-30">
            <p>
            <h1 class="text-3xl font-bold mb-3">Для вывода расписания укажите в строке поиска номер учебной группы</h1>
            <h2 class="text-red-900 text-2xl">Форма обучения и Курс являются обязательным полем</h2>
            </p>
        </div>
    @elseif(empty($schedule))
        <div class="empty_search">
            <p>
            <h1>Группа не найдена попробуйте еще</h1>
            </p>
        </div>
    @else
        <div id="scheduleTable">
            @foreach ($schedule as $gk => $group)
                @php
                    $edu = 0;
                    $daysOfWeek = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
                    $TimeLessons = ['08.00-09.20', '09.30-10.50', '11.00-12.20', '12:40-14:00', '14:10-15:30','15:40-17:00','17:10-18:30','18:40-20:00'];
                    $todayIndex = date('N');
                    $currentHour = date('H');
                    $currentMinute = date('i');
                    $maxWeekday = $maxWeekdays[$gk];
                @endphp
                @foreach ($group as $i => $les)
                    @foreach ($les as $k => $item)
                        @php
                            if(!empty($item)){
                                $edu = $item->form_edu;
                                if (is_string($edu)) {
                                    $edu = $edu[0];
                                }
                                break;
                            }
                        @endphp
                    @endforeach
                    @break
                @endforeach
                <h3 class="font-bold text-xl my-3">Группа: {{ $gk }}</h3>

                @if($maxWeekday <= 5)
                <div class="grid grid-cols-1 xl:grid-cols-[3%_5%_1fr_5%_1fr_5%_1fr_5%_1fr_5%_1fr_5%] gap-[2px] p-[2px] bg-[#D3D3D3]">
                    @else
                        <div class="grid grid-cols-[3%_5%_1fr_5%_1fr_5%_1fr_5%_1fr_5%_1fr_5%_1fr_5%] gap-1">
                    @endif

                        <div class="bg-red-900 font-bold text-white row-span-2 flex items-center justify-center p-2.5">№</div>
                        <div class="bg-red-900 font-bold text-white row-span-2 flex items-center justify-center p-2.5">Время</div>
                            @foreach ($daysOfWeek as $i => $day)
                                @if ($i + 1 <= $maxWeekday)
                                    @if ($edu == '2' || $edu == '3')
                                        <div class="{{ ($i + 1 == $todayIndex) ? 'today' : '' }} bg-red-900 text-white col-span-2 flex items-center justify-center p-2.5">
                                            {{ $day }}
                                        </div>
                                    @else
                                        <div class="bg-red-900 font-bold text-white col-span-2 flex items-center justify-center p-2.5" id="{{ ($i + 1 == 6) ? 'saturday' : '' }}" class="{{ ($i + 1 == $todayIndex) ? 'today' : '' }}">
                                            @if ($i + 1 == 6 && $maxWeekday <= 5)
                                            @else
                                                {{ $day }}
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            @endforeach

                        @if($maxWeekday <= 5)
                                    <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Дисциплина, вид занятия, преподаватель</div>
                                    <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Ауд.</div>

                                    <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Дисциплина, вид занятия, преподаватель</div>
                                    <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Ауд.</div>

                                    <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Дисциплина, вид занятия, преподаватель</div>
                                    <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Ауд.</div>

                                    <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Дисциплина, вид занятия, преподаватель</div>
                                    <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Ауд.</div>

                                    <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Дисциплина, вид занятия, преподаватель</div>
                                    <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Ауд.</div>

                        @else
                                <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Дисциплина, вид занятия, преподаватель</div>
                                <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Ауд.</div>

                                <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Дисциплина, вид занятия, преподаватель</div>
                                <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Ауд.</div>

                                <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Дисциплина, вид занятия, преподаватель</div>
                                <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Ауд.</div>

                                <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Дисциплина, вид занятия, преподаватель</div>
                                <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Ауд.</div>

                                <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Дисциплина, вид занятия, преподаватель</div>
                                <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Ауд.</div>

                                <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Дисциплина, вид занятия, преподаватель</div>
                                <div class="bg-red-900 flex items-center justify-center p-2.5 text-white font-bold">Ауд.</div>
                        @endif


                    @foreach ($group as $kt => $time)
                        @if (empty($TimeLessons[$kt-1])) @continue @endif

                            <div class="flex items-center justify-center p-2.5 bg-white">{{ $kt }}</div>
                            <div class="flex items-center justify-center p-2.5 bg-white">{{ $TimeLessons[(int)$kt-1] ?? '' }}</div>
                            @php $colDay = ($edu == '2' || $edu == '3') ? 6 : 5; @endphp
                            @for($i=1;$i <= $colDay;$i++)
                                @php
                                    list($lessonStartHour, $lessonStartMinute) = explode(':', str_replace('-', ':', $TimeLessons[$kt-1]));
                                    $lessonsEndHour = [];
                                    $lessonsEndMinute = [];
                                    $CurrentLesson = null;
                                    foreach ($TimeLessons as $key => $lessonTime) {
                                        $lessonTime = str_replace('.', ':', $lessonTime);
                                        list($lessonEndHour[$key], $lessonEndMinute[$key]) = explode(':', substr($lessonTime, strrpos($lessonTime, '-') + 1));
                                    }
                                    $currentTime = date('H:i');
                                    foreach ($TimeLessons as $key => $lessonTime) {
                                        $lessonTime = str_replace('.', ':', $lessonTime);
                                        list($lessonStartTime, $lessonEndTime) = explode('-', $lessonTime);
                                        $lessonStartTimeSeconds = strtotime($lessonStartTime);
                                        $lessonEndTimeSeconds = strtotime($lessonEndTime);
                                        $currentTimeSeconds = strtotime($currentTime);
                                        if ($currentTimeSeconds >= $lessonStartTimeSeconds && $currentTimeSeconds <= $lessonEndTimeSeconds) {
                                            $CurrentLesson = $key;
                                            break;
                                        }
                                    }
                                @endphp
                                <div class="{{ ($kt-1 == $CurrentLesson) && ($i == $todayIndex) && (!empty($time[$i]->subject)) ? 'current-lessons' : '' }} flex items-center justify-center p-2.5 bg-white whitespace-normal">
                                    @if(!empty($time[$i]->subject))
                                        {{ $time[$i]->subject }}, {{ $time[$i]->type ?? '' }} <br> {{ $time[$i]->teacher_name ?? '' }}
                                    @endif
                                </div>
                                <div class="flex items-center justify-center p-2.5 bg-white text-wrap">
                                    @if(!empty($time[$i]->auditory_name) &&$time[$i]->auditory_name == "Спорт.комплекс (пр.Б.Хмельницкого,1)")
                                        Спорт комплекс
                                    @else
                                        {{ $time[$i]->auditory_name ?? '' }}
                                    @endif

                                </div>
                            @endfor

                    @endforeach
                </div>
            @endforeach
        </div>
    @endif
                <div class="list-box">
                    @if ($schedule && $schedule != 'start')
                        @foreach ($schedule as $gk => $group)
                            @php  $maxWeekday = $maxWeekdays[$gk];  @endphp
                            <div>
                                <h3 class="text-xl font-bold my-3">Группа: {{ $gk }}</h3>
                            </div>
                            <div class="list-group">
                                @for ($day = 0; $day < 6; $day++)
                                    <div class="day-rasp grid grid-cols-1 gap-2 mb-2">
                                        @if ($day < 5 || ($day == 5 && $maxWeekday > 5))
                                            <div class="day-week{{ ($day + 1 == $todayIndex) ? 'today' : '' }} bg-red-900 p-2.5 font-bold">
                                                <h4 class="text-white">{{ $daysOfWeek[$day] }}</h4>
                                            </div>
                                            @foreach ($group as $kt => $time)
                                                @if (isset($time[$day + 1]) && !empty($time[$day + 1]->subject))
                                                    <div class="rasp-box bg-white">
                                                        <div class="item-box {{ ($kt - 1 == $CurrentLesson) && ($day + 1 == $todayIndex) && (!empty($time[$CurrentLesson]->subject)) ? 'current-lessons mr' : '' }} px-5 py-2.5">
                                                            <div class="font-bold my-2">
                                                                <span>Пара: № {{ $kt }}</span>
                                                            </div>
                                                            <div class="discip-rasp font-bold my-2">
                                                                <span>Дисциплина: {{ $time[$day + 1]->subject }}, {{ $time[$day + 1]->type ?? '' }}</span>
                                                            </div>
                                                            <div class="time-lesson my-2">
                                                                <span>Время: {{ $TimeLessons[$kt - 1] }}</span>
                                                            </div>
                                                            <div class="room-lesson my-2">
                                                                <span>Ауд. {{ $time[$day + 1]->auditory_name ?? '' }}</span>
                                                            </div>
                                                            <div class="teacher my-2">
                                                                <span>Преподаватель: {{ $time[$day + 1]->teacher_name ?? '' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        @endforeach
                    @endif
                </div>
    </section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const weekSelect = document.getElementById('week');
        const facultySelect = document.getElementById('faculty');
        const formEduSelect = document.getElementById('form_edu');
        const courseSelect = document.getElementById('course');
        const groupList = document.getElementById('groupList');

        function updateGroups() {
            const week = weekSelect.value;
            const faculty = facultySelect.value;
            const formEdu = formEduSelect.value;
            const course = courseSelect.value;

            fetch('{{ route('public.schedule.getGroups') }}' + `?week=${week}&faculty=${faculty}&form_edu=${formEdu}&course=${course}`)
                .then(response => response.text())
                .then(html => {
                    groupList.innerHTML = html;
                });
        }

        weekSelect.addEventListener('change', updateGroups);
        facultySelect.addEventListener('change', updateGroups);
        formEduSelect.addEventListener('change', updateGroups);
        courseSelect.addEventListener('change', updateGroups);
    });
</script>

