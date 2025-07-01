<?php

namespace App\Http\Controllers;

use App\Enums\Info\Base;
use App\Enums\Info\Common;
use App\Enums\Info\Types;
use App\Models\Documents\Document;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use App\Models\Info\Info;
use App\Models\Info\InfoCommon;
use App\Models\Info\InfoFounder;
use App\Models\News\Events;
use Illuminate\Support\Str;
use Illuminate\View\View;

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

        $host = Info::find(1);

        $item = Info::find(2);

        $item->relation()->associate($host)->save();

        dd($host->subs);

        dd($host,$item);


//        Info::create([
//            'type' => InfoType::Places,
//            'code' => CommonFields::addressPlaceSet,
//            'content' => 'address 1',
//        ]);
//        Info::create([
//            'type' => InfoType::Places,
//            'code' => CommonFields::addressPlaceSet,
//            'content' => 'address 2',
//        ]);
//        Info::create([
//            'type' => InfoType::Places,
//            'code' => CommonFields::addressPlaceSet,
//        ]);
//        Info::create([
//            'type' => InfoType::Places,
//            'code' => CommonFields::addressPlaceSet,
//            'content' => 'address 3',
//        ]);


//        $info = Info::Find(9);
//
//        $item = Info::find(11);
//
//        $item->relation()->associate($info)->save();
//
//        dd(
//            $item
//        );
//

        return view('test.index',compact('list'));
    }


}
