<?php

namespace App\Http\Controllers;

use App\Enums\EducationForm;
use App\Enums\EducationLevel;
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

    }

    public function view()
    {

        $gallery = Gallery::find(3);

        return view('test.view',compact('gallery'));
    }

    public function admin()
    {
        $list = Speciality::all();
        return view('test.admin',compact('list'));
    }

}
