<?php

namespace App\Http\Controllers;

use App\Enums\EducationBasis;
use App\Enums\EducationForm;
use App\Enums\EducationLevel;
use App\Imports\Import;
use App\Models\Education\Exam;
use App\Models\Education\Speciality;
use Illuminate\Http\Request;
use App\Models\Education\Faculty;
use App\Models\User;
use App\Enums\CardBG;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function index()
    {
        $list = Speciality::where('show',0)
            ->whereIn('level',[EducationLevel::Bachelor,EducationLevel::Master])
            ->orderBy('level')
            ->get();


        return view('test.page',compact('list'));
    }

}
