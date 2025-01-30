<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\{Document, FAQ, Link, Page, Staff, StaffAffiliation};
use App\Models\Education\Profile;
use App\Models\NewsCategory;
use App\Models\News;
use Illuminate\Support\Facades\View;
use App\View\Components\Specialities\AllSpeciality;

class TestController extends Controller
{
    public function index()
    {

        return view("pages.page-with-menu", [
            'sidebar'       => View::make('components.menu.sidebar')->with([
                'menu'          => &$menu,
                'full'          => false,
            ])->render(),

            'nobg'          => true,

            'contents'      => [
                (new AllSpeciality())->render(),
            ]

        ]);

//        $profile = Profile::find(1);
//
//        $profile->faq()->save(
//            new FAQ([
//                'question'  => 'test2',
//                'answer'    => 'test',
//                'order'     => 200
//            ])
//        );
//

        /**

        $profile->documents()->save(new Document([
            'title'     => 'test',
            'filename'  => 'test',
            'filetype'  => 'test',
        ]));

        dd($profile->documents()->count());
        /**/
//        dd($profile->documents()->where('show',true)->get()->pluck('show'));

//        $profile->documents()->save(new Link([
//            'name'      => 'test1',
//            'link'      => 'test1',
//            'order'     => 100,
//        ]));
//
//        $profile->documents()->save(new Link([
//            'name'      => 'test2',
//            'title'     => 'test2',
//            'order'     => 200,
//        ]));

//        dump($profile->links()->orderBy('order','desc')->get()->keyBy('id'));

//        $profile->documents()->save(new StaffAffiliation([
//            'staff_id'  => 1,
//            'alt_name'  => 'Sultan SV',
//            'post'      => 'test',
//            'order'     => 100,
//        ]));


//        dump($profile->staffs()->orderBy('order','desc')->first()->staff);
//        dd('--------------------------');
    }
}
