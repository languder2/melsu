<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function upload(Request $request, Gallery $gallery):RedirectResponse
    {

        $images = collect([]);

        foreach ($request->file('images') as $key => $file)
            $images->push(Image::upload($file,$gallery));


        if(!$gallery->preview()->exists)
            $gallery->preview()->fill(['reference_id' => $gallery->adminImages()->random()->id])->save();

        session()->put('last-upload-images', $images);

        return redirect()->to($gallery->admin_show);

    }

    public function adminShow(Gallery $gallery):view
    {

        $images = collect([]);

        if(session()->has('last-upload-images'))
            $images = session()->get('last-upload-images');

        return view('gallery.admin.show',compact('gallery','images'));
    }


    public function list()
    {

        $list= Gallery::orderBy('order')
            ->orderBy('name')
            ->get();


        return view('pages.admin', [
            'contents' => [

                view('admin.gallery.menu'),
                view('admin.gallery.gallery.top-line',[
                    'filter'    => @session()->get('admin-filter-gallery-images'),
                ]),
                view('admin.gallery.gallery.list',[
                    'list'      =>$list,
                ]),
//                View::make('components.admin.education.faculties.header')->with([])->render(),
            ]
        ]);

    }

    public function form(?Gallery $gallery)
    {
        return view('pages.admin', [
            'contents' => [

                view('admin.gallery.menu'),
                view('admin.gallery.gallery.form',compact(['gallery'])),
            ]
        ]);

    }

    public function save(Request $request, ?Gallery $gallery)
    {

        $form = $request->validate($gallery->FormRules($request->get('id')), $gallery->FormMessage());

        $gallery->fill($form);

        $gallery->save();



        if($request->file('image')){
            $image = Image::upload($request->file('image'),$gallery);
            $gallery->preview()->fill(['reference_id' => $image->id])->save();
        }
        elseif($form['preview']){
            $gallery->preview()->getReferenceID($form['preview']);
            $gallery->preview()->save();
        }
        else
            $gallery->preview()->delete();


        return redirect()->to($gallery->admin_show);
    }


}


