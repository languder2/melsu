<?php

namespace App\Http\Controllers;

use App\Enums\DivisionType;
use App\Enums\DurationType;
use App\Enums\EducationBasis;
use App\Enums\Info\Base;
use App\Enums\Info\Common;
use App\Enums\Info\Types;
use App\Models\Division\Division;
use App\Models\Documents\Document;
use App\Models\Education\Duration;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use App\Models\Global\Options;
use App\Models\Info\Info;
use App\Models\Info\InfoCommon;
use App\Models\Info\InfoFounder;
use App\Models\Info\InfoStandarts;
use App\Models\News\Events;
use App\Models\Staff\Staff;
use Illuminate\Support\Str;
use Illuminate\View\View;
use PhpOption\Option;

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



        $profiles = Profile::all();


        $profiles->each(function ($profile){
            $documents = $profile->documents()->each(function ($document) use ($profile){
                if($document->type === 'curriculum')
                    $document->getOption('code')->fill(['property' => 'educationPlan'])->save();
            })
            ;
        });

        return view('test.index',compact('list'));
    }


}
