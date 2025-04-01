<?php

namespace App\Http\Controllers;

use App\Enums\DurationType;
use App\Enums\EducationBasis;
use App\Enums\EducationForm;
use App\Enums\EducationLevel;
use App\Imports\Import;
use App\Models\Education\Exam;
use App\Models\Education\Profile;
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

//        $item = Profile::find(3);
//        $item->duration()->create([
//            'type'      => DurationType::OOO,
//            'duration'  => 55,
//            'comment'   => DurationType::OOO->getComment(),
//
//        ]);

        $item = new Profile();
        dump($item->duration('SOO'));
        dump($item->months('SOO'));
        dd();

        return view('test.page');

    }

}
