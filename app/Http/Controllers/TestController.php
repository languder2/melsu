<?php

namespace App\Http\Controllers;

use App\Enums\DivisionType;
use App\Enums\DocumentTypes;
use App\Enums\DurationType;
use App\Enums\EducationBasis;
use App\Enums\EducationForm;
use App\Enums\Entities;
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
            dump($item->event_datetime->format('H:i:s'));
            dump($item->FormatedEventDatetime('H:i'));
        }

//        return view('test.view',compact('list'));
    }

    public function admin()
    {
        $list = Speciality::all();
        return view('test.admin',compact('list'));
    }

    public function index(): View
    {

        $list = collect();

        dd(Entities::list());

        $page = Entities::page;

        return view('test.index',compact('list', 'page'));
    }


    public function staffs(): View
    {

        Employee::truncate();

        Division::where('type',DivisionType::Department)->get()->each(function ($item){
            $item->staffs->each(function ($staff){

                $staff->fill(['is_teacher' => 1])->save();

                if(!$staff->card->employee)
                    (new Employee([
                        "staff_id" => $staff->card->id,
                    ]))->save();
            });
        });


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
