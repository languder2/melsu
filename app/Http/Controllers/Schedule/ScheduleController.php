<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Schedule\ScheduleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ScheduleController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $schedule = DB::table('schedule')->orderBy('time')->get();
        $results = 'start';

        $weeks = DB::table('schedule')->distinct()->pluck('week')->toArray();
        $faculties = DB::table('schedule')->distinct()->pluck('faculty')->toArray();
        $courses = DB::table('schedule')->distinct()->orderBy('course')->pluck('course')->toArray();
        $groups = DB::table('schedule')->distinct()->pluck('group_name')->toArray();
        $forms_edu = DB::table('schedule')->distinct()->pluck('form_edu')->toArray();

        $data = [
            'schedule' => $results,
            'weeks'    => $weeks,
            'faculties' => $faculties,
            'courses' => $courses,
            'groups' => $groups,
            'forms_edu' => $forms_edu,
        ];
            return View::make('public.schedule.schedule', $data);
    }
    public function showSchedulePage():string
    {
        return view('admin.schedule.page');
    }
    public function importSchedule(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $jsonData = file_get_contents($file);
            $jsonData = mb_convert_encoding($jsonData, 'UTF-8', 'windows-1251');
            $jsonData = str_replace('\\', '/', $jsonData);
            $data = json_decode($jsonData, true);
            ScheduleModel::importFromJson($data);

            return Redirect::route('schedule.page')->with('success', 'Расписание успешно импортировано.');

        }
        else{
            return response()->json(['message' => 'Файл не найден'], 400);
        }
    }
    public function getGroups(Request $request)
    {
        $week = $request->input('week');
        $faculty = $request->input('faculty');
        $formEdu = $request->input('form_edu');
        $course = $request->input('course');

        $query = DB::table('schedule');

        if ($week) {
            $query->where('week', $week);
        }
        if ($faculty) {
            $query->where('faculty', $faculty);
        }
        if ($formEdu) {
            $query->where('form_edu', $formEdu);
        }
        if ($course) {
            $query->where('course', $course);
        }

        $groups = $query->pluck('group_name');

        $html = '';
        foreach ($groups as $group) {
            $html .= '<li data-id="1" class="drop-li min-h-[4rem] opacity-100 relative p-[1rem] bg-white text-lg flex items-center cursor-pointer transition duration-300 ease-in-out max-h-0 hover:bg-[#820000] hover:text-white [&.closed]:max-h-0 [&.closed]:overflow-hidden [&.closed]:p-0 [&.closed]:opacity-0 [&.closed]:min-h-[0px]">' . $group . '</li>';
        }

        return $html;
    }
    public function updateSchedule(Request $request)
    {
        $weeks = DB::table('schedule')->distinct()->pluck('week')->toArray();
        $faculties = DB::table('schedule')->distinct()->pluck('faculty')->toArray();
        $courses = DB::table('schedule')->distinct()->orderBy('course')->pluck('course')->toArray();
        $groups = DB::table('schedule')->distinct()->pluck('group_name')->toArray();
        $forms_edu = DB::table('schedule')->distinct()->pluck('form_edu')->toArray();

        $week = $request->input('week');
        $faculty = $request->input('faculty');
        $formEdu = $request->input('form_edu');
        $course = $request->input('course');
        $group = $request->input('group');

        $query = DB::table('schedule');

        if ($week) {
            $query->where('week', $week);
        }
        if ($faculty) {
            $query->where('faculty', $faculty);
        }
        if ($formEdu) {
            $query->where('form_edu', $formEdu);
        }
        if ($course) {
            $query->where('course', $course);
        }
        if ($group) {
            $query->where('group_name', $group);
        }

        $schedule = $query->get();
        $groupedSchedule = [];
        foreach ($schedule as $item) {
            if (isset($item->group_name, $item->time, $item->weekday)) {
                $groupedSchedule[$item->group_name][$item->time][$item->weekday] = $item;
                if (!isset($maxWeekdays[$item->group_name]) || $item->weekday > $maxWeekdays[$item->group_name]) {
                    $maxWeekdays[$item->group_name] = $item->weekday;
                }
            } else {
                // Обработка случая, когда свойства отсутствуют
                error_log("Object missing required properties: " . print_r($item, true));
            }
        }
        foreach ($groupedSchedule as &$group) {
            ksort($group);
        }

        return view('public.schedule.schedule', [
            'schedule' => $groupedSchedule,
            'maxWeekdays' => $maxWeekdays,
            'weeks'    => $weeks,
            'faculties' => $faculties,
            'courses' => $courses,
            'groups' => $groups,
            'forms_edu' => $forms_edu,]);
    }
}
