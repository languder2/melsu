<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Education\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Gallery\Image;
use App\Models\Gallery\Gallery;
class AdminImageGallery extends Controller
{
    public function list()
    {

        $list= Gallery::orderBy('id')
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

    public function form(Request $request, $id = null)
    {
        return view('pages.admin', [
            'contents' => [

                view('admin.gallery.menu'),
                view('admin.gallery.gallery.form',[
                    "current"   => Gallery::find($id)
                ]),
            ]
        ]);

    }

    public function save(Request $request)
    {

        $form = $request->validate(Gallery::FormRules($request->get('id')), Gallery::FormMessage());

        if (empty($request->get('id')))
            $record = new Gallery();
        else
            $record = Gallery::find($request->get('id'));

        if(empty($form['order']))
            unset($form['order']);

        $record->fill($form);
        $record->save();

        if(!$record->preview)
            $record->preview = $record->preview()->create([
                'name'          => $record->name,
                'type'          => 'preview',
            ]);


        if($request->file('image')){
            $record->preview->saveImage($request->file('image'),'images/news');
            $record->preview->reference_id = null;
        }
        elseif($form['preview']){
            $record->preview->name = $record->name;
            $record->preview->getReferenceID($form['preview']);
        }
        else{
            $record->preview->reference_id = null;
            $record->preview->filename = null;
            $record->preview->filetype = null;
        }

        $record->preview->save();

        return redirect()->route('admin:gallery:image:list');
    }


}
