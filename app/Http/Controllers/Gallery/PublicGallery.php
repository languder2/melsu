<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PublicGallery extends Controller
{
    function list():string
    {
        $list = Gallery::orderBy('order')->orderBy('name')->where('show',true)->get();

        return view("pages.page", [

            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'galleries',
                'element'   => null,
            ],

            'contents' => [
                view('gallery.gallery.list',[
                    'list'      =>$list,
                ]),
            ]

        ]);

    }
    function show(Request $request, $code):string|RedirectResponse
    {
        $gallery = Gallery::where('code',$code)->where('show',true)->first();

        if(!$gallery)
            return redirect()->route('public:gallery:list');

        return view("pages.page", [

            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'gallery',
                'element'   => $gallery,
            ],

            'contents' => [
                view('gallery.gallery.show',[
                    'gallery'      => $gallery,
                ]),
            ]
        ]);
    }

}
