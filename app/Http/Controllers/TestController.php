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
use App\Models\Page;
use App\Models\Page\Content;
use App\Models\Sections\Contact;
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

dd(\App\Models\Menu\Item::where('menu_id',$menu)
    ->where('id','!=',$id)
    ->whereNull('parent_id')
    ->select('name','id')
    ->orderBy('name')
    ->get());

        $specialities = Speciality::where('level',EducationLevel::Bachelor)->get();

        foreach ($specialities as $speciality)
            foreach ( $speciality->profiles as $profile) {
                foreach ($profile->duration as $duration){
                    $duration->fill([
                        'duration' =>  $profile->form === EducationForm::Full ? 48 : 54
                    ])->save();
                }

                $record = $profile->duration('SOO',true);
                if($record)
                    $record->delete();
            }

        $specialities = Speciality::where('level',EducationLevel::Master)->get();

        foreach ($specialities as $speciality)
            foreach ( $speciality->profiles as $profile) {
                foreach ($profile->duration as $duration){
                    $duration->fill([
                        'duration' =>  $profile->form === EducationForm::Full ? 24 : 30
                    ])->save();
                }

                $record = $profile->duration('SOO',true);
                if($record)
                    $record->delete();
            }

        $list = Content::where('content','like','%@mgu-mlt.ru%')->get();

        $list = $list->merge(Contact::where('content','like','%@mgu-mlt.ru%')->get());

        return view('test.page', compact('list'));
    }

    public function view()
    {
        return view('test.view');
    }


}
