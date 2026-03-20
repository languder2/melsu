<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Documents\DocumentCategory;
use App\Models\Staff\JobHistory;
use App\Models\Staff\Post;
use App\Models\Staff\Staff;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class FixController extends Controller
{
    public function divisionsCabinetLines():JsonResponse
    {
        Division::withDepth()->get()->each(fn($item) => $item->saveCacheCabinetItem());

        return response()->json(['success']);
    }
    public function documentCategoriesSort():JsonResponse
    {
        $list = DocumentCategory::orderBy('sort')->get()
            ->groupBy(fn($item) => $item->parent_id ."_". $item->relation_type . '_' . $item->relation_id);

        $list->each(fn($items) =>
        $items->each(fn($item, $key) =>
        $item->update(['sort' => ($key+1)*100])
        )
        );

        return response()->json(['success']);
    }

    public function employeesSetUUID():JsonResponse
    {

        $heads = [
            'Декан факультета',
            'Директор',
            'Директор департамента',
            'Директор филиала',
            'Заведующий',
            'Заведующий лабораторией',
            'Заведующий общежитием',
            'Заведующий отделом',
            'Заведующий учебно-производственным комплексом',
            'Заведующий учебным корпусом',
            'Заведующий хозяйством',
            'Начальник',
            'Начальник комплекса апробации',
            'Начальник управления',
            'Ректор',
            'Руководитель',
            'Руководитель вокально-инструментального ансамбля',
            'Руководитель вокального коллектива',
            'Руководитель хореографического коллектива',
        ];


        $json = Storage::disk('private')->json('json/employee.json');

        if(is_null($json) || !array_key_exists('employee', $json))
            abort(404);


        $employees = collect($json['employee']);

        $employees = $employees->filter(fn($item) => !$item['dismissed'] && !$item['deleted']);

        $grouped = $employees->groupBy('uid_person');

        $grouped->each(function ($group) {
            $item = $group->first();

            $fio = [
                'lastname'      => trim($item['surname']),
                'firstname'     => trim($item['name']),
                'middle_name'   => trim($item['patronymic']),

            ];

            Staff::updateOrCreate($fio,['uuid' => $item['uid_person']]);
        });

        $grouped->each(function ($group, $uuid) use ($heads) {

            $staff = Staff::where('uuid', $uuid)->first();

            if(is_null($staff)) return;

            foreach ($group as $post) {

                $division = Division::where('uuid', $post['uid_department'])->first();

                if(is_null($division)) continue;

                if(Post::where('uuid', $post['uid_employee'])->count()) continue;

                $position = trim($post['position']);

                Post::createOrRestore([
                    'uuid'                  => $post['uid_employee'],
                    'staff_id'              => $staff->id,
                    'division_id'           => $division->id,
                    'post'                  => $position,
                    'is_head_of_division'   => $post['head_of_division'],
                    'is_show'               => true,
                ]);
            }
        });

        self::employeesSetIsTeacher();

        return response()->json(['success']);
    }

    public function employeesDesmissedUUID():JsonResponse
    {

        $json = Storage::disk('private')->json('json/employee.json');

        if(is_null($json) || !array_key_exists('employee', $json))
            abort(404);


        $employees = collect($json['employee']);

        $grouped = $employees->groupBy('uid_person');

        $grouped = $grouped->filter(fn($group) => $group->every('dismissed', true));

        dd($grouped);

        return response()->json(['success']);
    }

    public function employeesSetIsTeacher():JsonResponse
    {

        $posts = [
            'Доцент',
            'Профессор',
            'Преподаватель',
            'Старший преподаватель',
        ];

        Post::query()->whereIn('post', $posts)->update(['is_teacher' => true]);

        return response()->json(['success']);
    }

    public function employeesUpdatePosts(): JsonResponse
    {
        $json = Storage::disk('private')->json('json/employee.json');

        if(is_null($json) || !array_key_exists('employee', $json))
            abort(404);


        $employees = collect($json['employee']);

        $employees = $employees->filter(fn($item) => !$item['deleted']);

        $grouped = $employees->groupBy('uid_person');

        $grouped->each(function ($group) {
            $item = $group->first();

            $fio = [
                'lastname'      => trim($item['surname']),
                'firstname'     => trim($item['name']),
                'middle_name'   => trim($item['patronymic']),

            ];

            Staff::updateOrCreate($fio,['uuid' => $item['uid_person']]);
        });

        $grouped->each(function ($group, $uuid){

            $staff = Staff::where('uuid', $uuid)->first();


            if(is_null($staff)) return;

            foreach ($group as $post) {

                $division = Division::where('uuid', $post['uid_department'])->first();

                if(is_null($division)) continue;

                $position = trim($post['position']);

                $record = Post::withTrashed()->where('uuid', $post['uid_employee'])->firstOrNew();

                $record->fill([
                    'uuid'                  => $post['uid_employee'],
                    'staff_id'              => $staff->id,
                    'division_id'           => $division->id,
                    'post'                  => $position,
                    'is_head_of_division'   => (int) $post['head_of_division'],
                    'deleted_at'            => $post['dismissed'] ? Carbon::parse($post['date_dismissal']) : null
                ])->save();

                if($post['dismissed'])
                    $record->delete();

            }
        });

        self::employeesSetIsTeacher();

        return response()->json(['success']);
    }


}
