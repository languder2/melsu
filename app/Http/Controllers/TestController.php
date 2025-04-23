<?php

namespace App\Http\Controllers;

use App\Enums\EducationForm;
use App\Enums\EducationLevel;
use App\Models\Education\Speciality;
use App\Models\Page\Content;
use App\Models\Sections\Contact;

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
