<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Gallery\Gallery;
use Illuminate\View\View;

class AdminImageGallery extends Controller
{
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

        $record->show = @$form['show']?true:"";

        $record->save();

        if(!$record->preview)
            $record->preview = $record->preview()->create([
                'name'          => $record->name,
                'type'          => 'preview',
            ]);


        if($request->file('image')){
            $record->preview->saveImage($request->file('image'),'images/gallery');
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


    public function ApiToggleShow (Request $request,$id): JsonResponse
    {

        $gallery = Gallery::Find($id);

        if(!$gallery)
            return response()->json([],204);

        $gallery->show = $gallery->show?'':true;
        $gallery->save();

        return response()->json(
            [
                'message' => ($gallery->show?"Галерея опубликована":'Галерея скрыта')."\n{$gallery->name}"
            ]);
    }
    public function ApiDelete (Request $request,$id): JsonResponse
    {

        $gallery = Gallery::Find($id);

        if(!$gallery)
            return response()->json([],204);

        $gallery->delete();

        return response()->json(
            [
                'message' => "Галерея удалена\n{$gallery->name}\n Восстановимо до: "
                    .Carbon::now()->addWeek(2)->format('d.m.Y H:i')
            ]);
    }
    public function formMultiUploads(Request $request, Gallery $gallery):View
    {
        dump($gallery);

        return view('gallery.images.admin.form-multi-upload',compact('gallery'));
    }

}
