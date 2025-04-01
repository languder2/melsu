<?php

namespace App\Http\Controllers\Staffs;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;

class ApiStaff extends Controller
{
    public function getTeachersByDepartments()
    {
        $result= collect([]);

        $list = Division::where('type',DivisionType::Department)->where('show',true)->get();

        foreach($list as $department){
            foreach($department->staffs as $affiliate){
                if(!$affiliate->card) continue;

                $result->push([
                    $affiliate->card->full_name,
                    $affiliate->post,
                    $department->name,
                ]);
            }
        }
        return $result;

    }

}
