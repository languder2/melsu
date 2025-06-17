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
        dump(auth()->check());

        dump(auth()->user());
        dump(auth()->check());
//        return view('test.view',compact('list'));
    }

    public function admin()
    {
        $list = Speciality::all();
        return view('test.admin',compact('list'));
    }

}
