<?php

namespace App\Http\Controllers;

use App\Enums\DivisionType;
use App\Enums\DurationType;
use App\Enums\EducationBasis;
use App\Enums\EducationForm;
use App\Enums\Info\Base;
use App\Enums\Info\Common;
use App\Enums\Info\Types;
use App\Models\Division\Division;
use App\Models\Documents\Document;
use App\Models\Education\Duration;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use App\Models\Employees\Employee;
use App\Models\Global\Options;
use App\Models\Info\Info;
use App\Models\Info\InfoCommon;
use App\Models\Info\InfoFounder;
use App\Models\Info\InfoStandarts;
use App\Models\News\Events;
use App\Models\Staff\Affiliation;
use App\Models\Staff\Staff;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use PhpOption\Option;
use function PHPUnit\Framework\matches;

class TestController extends Controller
{
    public function token()
    {
        dump(session()->token());
    }

    public function phpinfo():void
    {

        phpinfo();

    }

    public function view()
    {
        $list = collect([]);

        $list = Events::whereNotNull('event_datetime')->get();

        foreach ($list as $item) {
            @dump($item->event_datetime->format('H:i:s'));
            @dump($item->FormatedEventDatetime('H:i'));
        }

//        return view('test.view',compact('list'));
    }

    public function admin()
    {
        $list = Speciality::all();
        return view('test.admin',compact('list'));
    }

    public function index(InfoCommon $common): View
    {
        $list = collect([]);

        Affiliation::whereNotNull('staff_id')->get()->each(function ($item){
            $item->full_name = $item->card->full_name;

            $item->save();
        });




        dd();

        $list = Profile::get()->where(fn($item) => $item->speciality);

        foreach ($list as $item)
            if($item->speciality && $item->speciality->level){

                $item->duration = $item->speciality->level->getCurses()*12;

                if($item->speciality->spec_code === '44.03.05')
                    $item->duration = 60;

                if( in_array($item->speciality->spec_code,['2.4.4', '4.1.1', '1.5.9', '2.5.21']) )
                    $item->duration = 48;

                if($item->form !== EducationForm::Full)
                    $item->duration += 6;

                if($item->duration)
                    $item->save();
            }

        dd($list);

        $json = Storage::json('employees.json');

        Employee::truncate();

        foreach ($json as $employee)
            Employee::create($employee);

        $list = Employee::all();

        return view('test.index',compact('list','json'));
    }


    public function staffs(): View
    {
//        $list   = Staff::all()->groupBy('full_name')->where(fn($item) => $item->count()>1);
//
//        $list2  = Staff::all()->where(fn($item) => $item->Affiliations->count() === 0)->groupBy('full_name');
//
//        foreach ($list2 as $code=>$item)
//            if(!$list->has($code))
//                $list->put($code,$item);

        $list  = Staff::all()->where(fn($item) => $item->Affiliations->count() === 0)->each(fn($item) => $item->delete());
        $list  = Staff::all()->where(fn($item) => $item->Affiliations->count() === 0)->groupBy('full_name');

        return view('test.staffs',compact('list'));
    }


}
