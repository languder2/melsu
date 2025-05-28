<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\Image;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

        if($request->get('gallery'))
            session()->flash('gallery-image-add',$request->get('gallery'));

        return view('pages.admin', [
            'contents' => [

                view('admin.gallery.menu'),
                view('admin.gallery.image.form',[
                    "current"       => Image::find($id),
                    'galleries'     => Gallery::orderBy('order')->orderBy('name')->get()->pluck('name','code'),
                    'addTo'         => $request->get('gallery'),
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

        $gallery = Gallery::where('code',$form['gallery_code'])->first();

        if($gallery)
            $record->relation()->associate($gallery);

        $record->save();


        if($request->file('image')){

            $record->saveImage($request->file('image'));

            $record->save();
        }



        return redirect()->route(
            (bool)session()->get('gallery-image-add')
                ?'admin:gallery:image:list'
                :'admin:image:list'
        );
    }
}
