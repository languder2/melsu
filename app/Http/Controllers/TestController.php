<?php

namespace App\Http\Controllers;

use App\Enums\DivisionType;
use App\Enums\EducationForm;
use App\Enums\EducationLevel;
use App\Models\Division\Division;
use App\Models\Education\Speciality;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\Image;
use App\Models\News\RelationNews;
use App\Models\Page\Content;
use App\Models\Sections\Contact;
use App\Models\User;

class TestController extends Controller
{
    public function index()
    {
        dd(3);
    }

    public function view()
    {
        $list = Speciality::all();


        $list->each(function ($item) {
            if (preg_match('/\((.*?)\)/', $item->name, $matches)) {
                $item->fill([
                    'name' => trim(mb_substr($item->name,0,mb_strpos($item->name,'('))),
                    'name_profile' => $matches[1]
                ])->save();
            }
        });

        dd(1);

//        if (preg_match($pattern, $value, $matches)) {
//
//            $code= $matches[1];
//
//

        dd(1);

            dd(1);

        $list = Division::where('type',DivisionType::Branch)->get();

        return view('test.view',compact('list'));
    }

    public function admin()
    {
        $list = Speciality::all();
        return view('test.admin',compact('list'));
    }

}
