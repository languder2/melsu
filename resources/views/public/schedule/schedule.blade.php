@extends("layouts.main")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'departments',null)}}
@endsection
<?php function getWeekNumberFromSeptember($date) {
// Преобразуем дату в объект DateTime
$dateTime = new DateTime($date);

// Устанавливаем дату начала учебного года (1 сентября)
$startDateTime = new DateTime('2024-09-01'); // Замените на нужный год

// Вычисляем разницу в днях
$diff = $dateTime->diff($startDateTime);

// Вычисляем номер недели
$weekNumber = (int) floor(($diff->days + $startDateTime->format('w')) / 7) + 1;

return $weekNumber;
}
?>

@section('content')
    <section class="p-2.5">
    <div class="border-2 border-red-900 p-6 ">
        <form class="flex gap-2">
            <div>
                <select id="week" name="week" class="bg-white p-2.5 appearance-none border border-red-900 w-50">
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
                <select id="faculty" class="bg-white p-2.5 appearance-none border border-red-900 w-50" name="faculty">
                    <option value="">Факультет</option>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty }}">{{ $faculty }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select id="form_edu" name="form_edu" class="bg-white p-2.5 appearance-none border border-red-900 w-50" required>
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
                    <select id="course" name="course" class="bg-white p-2.5 appearance-none border border-red-900 w-50" required>
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
                <input class="chosen-value relative top-0 left-0 bg-white p-2.5 appearance-none border border-red-900 w-50
                             transition duration-300 ease-in-out placeholder:text-[black] focus:border-b-[2px] outline-0 z-20"
                       type="text" value="" placeholder="Группа">
                <ul class="value-list transition duration-300 ease-in-out absolute top-0 left-0 w-full max-h-0 cursor-pointer list-none mt-[48px] shadow-[2px_24px_17px_-13px_rgba(66, 68, 90, 1)] overflow-hidden
                [&.open]:max-h-[320px] [&.open]:overflow-auto z-20">
                    <li data-id="1" class="drop-li min-h-[4rem] opacity-100 relative p-[1rem] bg-white text-lg flex items-center cursor-pointer transition duration-300 ease-in-out max-h-0 hover:bg-[#820000] hover:text-white
                                [&.closed]:max-h-0 [&.closed]:overflow-hidden [&.closed]:p-0 [&.closed]:opacity-0 [&.closed]:min-h-[0px]">
                        Главное в МелГУ
                    </li>
                    <li data-id="2" class="drop-li min-h-[4rem] relative p-[1rem] bg-white text-lg flex items-center cursor-pointer transition duration-300 ease-in-out max-h-0 hover:bg-[#820000] hover:text-white
                                [&.closed]:max-h-0 [&.closed]:overflow-hidden [&.closed]:p-0 [&.closed]:opacity-0 [&.closed]:min-h-[0px]">
                        Наука
                    </li>
                </ul>
            </div>
            <button class="p-2.5 appearance-none border border-red-900 w-50 transition duration-300 ease-linear hover:bg-red-900 hover:text-white cursor-pointer">Применить</button>
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
                <h3>Группа: {{ $gk }}</h3>
                <table>
                    <thead style="background-color: #820000; color: #ffffff;">
                    <tr>
                        <td style="width: 3%" rowspan="2">№</td>
                        <td style="width: 3%" rowspan="2">Время</td>
                        @foreach ($daysOfWeek as $i => $day)
                            @if($edu == '2' || $edu == '3')
                                <td style="width: 20%;" colspan="2" class="{{ ($i + 1 == $todayIndex) ? 'today' : '' }}">{{ $day }}</td>
                            @else
                                <td style="width: 20%;" colspan="2" id="{{ ($i + 1 == 6) ? 'saturday' : '' }}" class="{{ ($i + 1 == $todayIndex) ? 'today' : '' }}">
                                    @if($day !== 'Суббота')
                                        {{ $day }}
                                    @elseif ($day == 'Суббота' && $edu !== '2' && $edu !== '3')

                                    @endif
                                </td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        @if($edu == '1')
                            <td style="width: 15%;">Дисциплина, вид занятия, преподаватель</td>
                            <td style="width: 3%;">Ауд.</td>
                            <td style="width: 15%;">Дисциплина, вид занятия, преподаватель</td>
                            <td style="width: 3%;">Ауд.</td>
                            <td style="width: 15%;">Дисциплина, вид занятия, преподаватель</td>
                            <td style="width: 3%;">Ауд.</td>
                            <td style="width: 15%;">Дисциплина, вид занятия, преподаватель</td>
                            <td style="width: 3%;">Ауд.</td>
                            <td style="width: 15%;">Дисциплина, вид занятия, преподаватель</td>
                            <td style="width: 3%;">Ауд.</td>
                        @else
                            <td style="width: 12%;">Дисциплина, вид занятия, преподаватель</td>
                            <td style="width: 3%;">Ауд.</td>
                            <td style="width: 12%;">Дисциплина, вид занятия, преподаватель</td>
                            <td style="width: 3%;">Ауд.</td>
                            <td style="width: 12%;">Дисциплина, вид занятия, преподаватель</td>
                            <td style="width: 3%;">Ауд.</td>
                            <td style="width: 12%;">Дисциплина,вид занятия, преподаватель</td>
                            <td style="width: 3%;">Ауд.</td>
                            <td style="width: 12%;">Дисциплина, вид занятия, преподаватель</td>
                            <td style="width: 3%;">Ауд.</td>
                            <td style="width: 12%;">Дисциплина, вид занятия, преподаватель</td>
                            <td style="width: 3%;">Ауд.</td>
                            <td style="width: 12%;">Дисциплина, вид занятия, преподаватель</td>
                            <td style="width: 3%;">Ауд.</td>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($group as $kt => $time)
                        @if (empty($TimeLessons[$kt-1])) @continue @endif
                        <tr>
                            <td>{{ $kt }}</td>
                            <td>{{ $TimeLessons[(int)$kt-1] ?? '' }}</td>
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
                                <td class="{{ ($kt-1 == $CurrentLesson) && ($i == $todayIndex) && (!empty($time[$i]->subject)) ? 'current-lessons' : '' }}">
                                    @if(!empty($time[$i]->subject))
                                        {{ $time[$i]->subject }}, {{ $time[$i]->type ?? '' }} <br> {{ $time[$i]->teacher_name ?? '' }}
                                    @endif
                                </td>
                                <td>{{ $time[$i]->auditory_name ?? '' }}</td>
                            @endfor
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    @endif
    </section>
@endsection



