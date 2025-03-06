<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Import;
use App\Models\Department\Department;
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
                $department = Department::where('name',trim($row[0]))->first();
                $type = 'chief';
            }


            if($row[5] && !$department)
                $department = Department::find($row[5]);

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
}
