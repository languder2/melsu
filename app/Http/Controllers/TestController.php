<?php

namespace App\Http\Controllers;

use App\Models\Education\Profile;
use App\Models\Education\Speciality;
use App\Models\News\Events;
use Illuminate\View\View;

class TestController extends Controller
{
    public function token()
    {
        $_SESSION['text'] = 321;

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

    public function index(): View
    {
        $list = collect([]);

        $list = Profile::all();

        foreach ($list as $item) {

            $item->fill(['is_recruitment' => $item->budget_places || ($item->contract_places && $item->price)])->save();

        }


        $list = Speciality::all();

        foreach ($list as $item) {
            $item->isRecruitmentBasedOnFormRecruitment();
        }

        $list = Speciality::where('show',true)->where('is_recruitment',true)->get();


        return view('test.index',compact('list'));
    }


}
