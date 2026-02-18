<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Documents\DocumentCategory;
use App\Models\Staff\Staff;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FixController extends Controller
{
    public function divisionsCabinetLines():JsonResponse
    {

        Division::all()->each(fn($item) => $item->saveCacheCabinetItem());

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

        $json = Storage::disk('private')->json('json/employee.json');

        if(is_null($json) || !array_key_exists('employee', $json))
            abort(404);


        $employees = collect($json['employee']);

        $grouped = $employees->groupBy('uid_person');

        $grouped->each(function ($group) {
            $item = $group->first();

            $fio = [
                'lastname'      => $item['surname'],
                'firstname'     => $item['name'],
                'middle_name'   => $item['patronymic'],

            ];

            $staff = Staff::where($fio)->firstOrNew($fio);

            $staff->fill(['uuid' => 123])->save();

            dd($staff);


            Staff::updateOrCreate([
                'lastname'      => $item['surname'],
                'firstname'     => $item['name'],
                'middle_name'   => $item['patronymic'],

            ],[
                'uuid'           => $item['uid_person'],
            ]);


            dd($item['surname'], $item['uid_person']);
        });

        dd($grouped);

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

}
