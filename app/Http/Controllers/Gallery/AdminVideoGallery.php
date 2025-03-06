<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;

class AdminVideoGallery extends Controller
{
    public function list()
    {
        return view('pages.admin', [
            'contents' => [

                view('admin.gallery.menu'),
                view('admin.gallery.video.list'),
//                View::make('components.admin.education.faculties.header')->with([])->render(),
            ]
        ]);

    }
}
