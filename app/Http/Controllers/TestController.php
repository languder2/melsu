<?php

namespace App\Http\Controllers;

use App\Models\Documents\Document;
use App\Models\Education\Profile;
use App\Models\Education\Speciality;
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

    public function index(): View
    {
        $list = collect([]);

        $item = new Document([
            'title'     => 100,
            'sort'      => 300,
        ]);

        dump($item->id);

        dump($item->id);
        dump($item->id);
        dump($item->id);
        dump($item->id);

        $item->save();

        dump($item->id);
        dump($item->id);
        dump($item->id);
        dump($item->id);

        dd($item);

        return view('test.index',compact('list'));
    }


}
