<?php

namespace App\Http\Controllers;

use App\Enums\EducationForm;
use App\Models\Education\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Import;
use App\Models\Division\Division;
use App\Models\Staff\Staff;
use App\Models\Staff\Affiliation;
class ImportController extends Controller
{
    public function DepartmentsGetFile()
    {

        return view('pages.admin', [
            'contents' => [
                View('admin.Imports.form'),
            ]
        ]);
    }

    public function DepartmentsUpdate(Request $request)
    {

        if(!$request->file('file'))
            dd('no file');

        Affiliation::truncate();

        $import = new Import();

        Excel::import($import, $request->file('file'));

        $data = $import->getData();

        $counter = 0;
        $staffs = (object)[
            'exist' => 0,
            'no_exist' => 0,
        ];

        foreach ($data as $rowID=>$row) {

            $type= 'staff';

            if($row[0]){
                $department = Division::where('name',trim($row[0]))->first();
                $type = 'chief';
            }


            if($row[5] && !$department)
                $department = Division::find($row[5]);

            if($row[0] && !$department){
                $counter++;
                echo "<div style='display: flex; gap: 20px; margin-top: 10px;'>";
                    echo "<div style='width: 10ch'>$counter</div>";
                    echo "<div style='width: 10ch'>{$row[1]}</div>";
                    echo "<div>{$row[0]}</div>";
                echo "</div>";
            }

            if(!$department)
                continue;

            $fullName = trim($row[4]);

            if(!$fullName)
                continue;

            $fullName = explode(' ', $fullName);

            $staff = Staff
                ::where('lastname',@$fullName[0])
                ->where('firstname',@$fullName[1])
                ->where('middle_name',@$fullName[2])
                ->first();

            if(!$staff)
                $staff = Staff::create([
                    'lastname'      => @$fullName[0] ?? null,
                    'firstname'     => @$fullName[1] ?? null,
                    'middle_name'   => @$fullName[2] ?? null,
                ]);

            $post = trim($row[2]);
            $post = strip_tags($post);
            $post = str_replace(PHP_EOL,'',$post);

            $item = $department->staffs()->create([
                'type'      => $type,
                'staff_id'  => @$staff->id,
                'post'      => $post,
                'full_name' => $staff->full_name ?? null,
            ]);
        }

    }

    public function setScores()
    {
        $import = new Import();

        Excel::import($import, Storage::disk('public')->path('xlsx/specialities.xlsx'));

        $data = $import->getData();

        foreach ($data as $rodID=>$item) {
            $speciality = Speciality::find($item[0]);

            if(!$speciality) {
                dump("$rodID: no speciality found");
                continue;
            }

            $speciality->fill(['show'=>true])->save();

            $profile =
                $speciality->profileByForm($item[1])
                ?? $speciality->profiles()->create(['form'  => EducationForm::tryFrom($item[1])]);

            $profile->fill(['show'=>true])->save();

            $score = $profile->score()->firstWhere('type',$item[2])
                ?? $profile->score()->create(['type'=>$item[2]]);

            $score->fill(['score'=>$item[3]])->save();
        }

    }
}
