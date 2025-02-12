<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Education\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Gallery\Image;
class AdminImageGallery extends Controller
{
    public function list()
    {

        $list= Image::inRandomOrder()->paginate(60);

        return view('pages.admin', [
            'contents' => [

                view('admin.gallery.menu'),
                view('admin.gallery.image.list',[
                    'list'      =>$list,
                ]),
//                View::make('components.admin.education.faculties.header')->with([])->render(),
            ]
        ]);

    }
}
