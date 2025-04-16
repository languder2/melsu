<?php

namespace App\Http\Controllers;

use App\Enums\DurationType;
use App\Enums\EducationBasis;
use App\Enums\EducationForm;
use App\Enums\EducationLevel;
use App\Enums\UserRoles;
use App\Imports\Import;
use App\Jobs\SendEmailJob;
use App\Mail\SendEmail;
use App\Models\Division\Division;
use App\Models\Education\Exam;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use App\Models\Log;
use App\Models\Page\Content;
use Illuminate\Http\Request;
use App\Models\Education\Faculty;
use App\Models\User;
use App\Enums\CardBG;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function index()
    {
        $all = Content::where('content','like','%mgu-mlt.ru%')->get();
        foreach ($all as $item) {
            $item->content = str_replace('mgu-mlt.ru','old.melsu.ru',$item->content);
            $item->content = str_replace('https://old.melsu.ru','http://old.melsu.ru',$item->content);
            $item->save();
        }

        dd($all);
        return view('test.page');
    }

}
