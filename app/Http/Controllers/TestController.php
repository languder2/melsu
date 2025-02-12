<?php

namespace App\Http\Controllers;

use App\Models\Department\Department;
use App\Models\Department\Section;

class TestController extends Controller
{
    public function index()
    {


        return view('pages.page',[
            'contents'  => [
                view('test')
            ]
        ]);
        $department = Department::where('alias', 'rectorate')->first();

        dump($department->chief_card?->link);
        dump($department->staffs);
        dump($department->toArray());


        dd('end');

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
         *
         * $profile->documents()->save(new Document([
         * 'title'     => 'test',
         * 'filename'  => 'test',
         * 'filetype'  => 'test',
         * ]));
         *
         * dd($profile->documents()->count());
         * /**/
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
