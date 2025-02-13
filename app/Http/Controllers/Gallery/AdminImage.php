<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery\Image;
use Illuminate\Http\Request;

class AdminImage extends Controller
{
    public function list()
    {

        $list= Image::whereNull('reference_id')
            ->whereNotNull('filename')
            ->orderBy('id','desc')
            ->paginate(60);

        return view('pages.admin', [
            'contents' => [

                view('admin.gallery.menu'),
                view('admin.gallery.image.top-line',[
                    'filter'    => @session()->get('admin-filter-images'),
                ]),
                view('admin.gallery.image.list',[
                    'list'      =>$list,
                ]),
//                View::make('components.admin.education.faculties.header')->with([])->render(),
            ]
        ]);

    }

    public function form(Request $request, $id = null)
    {
        return view('pages.admin', [
            'contents' => [

                view('admin.gallery.menu'),
                view('admin.gallery.image.form',[
                    "current"   => Image::find($id)
                ]),
            ]
        ]);

    }

    public function save(Request $request)
    {
        $form = $request->validate(Image::FormRules($request->get('id')), Image::FormMessage());

        if (empty($request->get('id')))
            $record = new Image();
        else
            $record = Image::find($request->get('id'));

        if(empty($form['order']))
            unset($form['order']);

        $record->fill($form);

        $record->save();


        if($request->file('image')){

            $record->saveImage($request->file('image'));

            $record->save();
        }

        return redirect()->route('admin:gallery:image:list');
    }
}
