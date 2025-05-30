<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function formMultiUploads(Request $request, Gallery $gallery):View
    {
        dump($gallery);

        return view('gallery.images.admin.form-multi-upload',compact('gallery'));
    }
}
