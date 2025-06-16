<?php

namespace App\Http\Controllers;

use App\Enums\DivisionType;
use App\Enums\EducationForm;
use App\Enums\EducationLevel;
use App\Models\Division\Division;
use App\Models\Education\Profile;
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

        $list = Profile::get();

        $list = $list->sortByDesc('price');

        foreach ($list as $item){
            $item->fill([
                "speciality_id"     => $item->speciality->id ?? null,
            ])->save();
        }


        return view('test.view',compact('list'));
    }

    public function admin()
    {
        $list = Speciality::all();
        return view('test.admin',compact('list'));
    }

}
