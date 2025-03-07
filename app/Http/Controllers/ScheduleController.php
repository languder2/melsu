<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;

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
        }
        else{
            return response()->json(['message' => 'Файл не найден'], 400);
        }
    }
}
