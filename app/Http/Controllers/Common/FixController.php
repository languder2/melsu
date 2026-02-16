<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Documents\DocumentCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FixController extends Controller
{
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


    public function employeesUUID():JsonResponse
    {

        if(!Storage::disk('private')->exists('json/employee.json'))
            abort(404, "Not found json file");


        $file = json_decode(Storage::disk('private')->get('json/employee.json'));

        if(is_null($file))
            abort(400, 'Not json file');

        if(is_null($file->employee))
            abort(400, 'Not employees in json file');

        $employees = collect($file->employee)
            ->each(fn($item) => $item->fio = $item->surname . " " . $item->name . " " . $item->patronymic)
            ->keyBy('fio')
        ;

        $grouped = $employees->filter(fn($item) => $item->surname === "Артюхов");

        dd($grouped);







        dd($employees, $test, $test->first());



//        $dismissal = $employees->groupBy('date_dismissal');
//
//        dd($dismissal);
//


        return response()->json(['success']);
    }

}
