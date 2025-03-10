<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ScheduleModel extends Model
{
    use HasFactory;

    protected $table = 'schedule';

    protected $fillable = [
        'week_number',
        'group_name',
        'course',
        'faculty',
        'form_edu',
        'weekday',
        'subject',
        'type',
        'subgroup',
        'time_start',
        'time_end',
        'time',
        'week',
        'date',
        'teacher_name',
        'teacher_id',
        'auditory_name',
        'Lesson_ID_Num',
    ];

    public static function importFromJson($json)
    {
        foreach ($json as $timetableItem) {
            foreach ($timetableItem['timetable'] as $weekData) {
                foreach ($weekData['groups'] as $group) {
                    foreach ($group['days'] as $day) {
                        $thirdSymbol = substr($group['group_name'], 2, 1);
                        $fourthSymbol = substr($group['group_name'], 3, 1);

                        if ($thirdSymbol === "3") {
                            $group['course'] = 6;
                        }

                        if (array_key_exists('lessons', $day)) {
                            foreach ($day['lessons'] as $lesson) {
                                if (empty($lesson['date'])) {
                                    $lesson['date'] = '0000-00-00';
                                } else {
                                    $lesson['date'] = date('Y-m-d', strtotime($lesson['date']));
                                }

                                if (empty($group['faculty'])) {
                                    $group['faculty'] = 'Факультет не указан';
                                }

                                $auditoryName = $lesson['auditories'][0]['auditory_name'] ?? '';
                                if (strpos($auditoryName, '25') === 0) {
                                    $auditoryName = 'ДО';
                                }

                                $insertData = [
                                    'group_name' => $group['group_name'],
                                    'course' => $group['course'],
                                    'faculty' => $group['faculty'],
                                    'form_edu' => $fourthSymbol,
                                    'weekday' => $day['weekday'],
                                    'subject' => $lesson['subject'] ?? null,
                                    'type' => $lesson['type'] ?? '',
                                    'time' => $lesson['time'] ?? '',
                                    'week' => $lesson['week'] ?? '',
                                    'time_start' => $lesson['time_start'] ?? null,
                                    'time_end' => $lesson['time_end'] ?? null,
                                    'date' => $lesson['date'],
                                    'teacher_name' => $lesson['teachers'][0]['teacher_name'] ?? '',
                                    'auditory_name' => $auditoryName,
                                ];

                                self::firstOrCreate($insertData);

                            }
                        }
                    }
                }
            }
        }
    }

}
