<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\Department\Group;
use App\Models\Gallery\Gallery;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function list()
    {
        return view('pages.admin', [
            'contents' => [
                View('admin.department.menu'),
                View('admin.department.group.header'),
                View('admin.department.group.list',[
                    'list'      => Group::paginate(20),
                ]),
            ]
        ]);
    }

    public function form(Request $request, $id = null)
    {
        return view('pages.admin', [
            'contents' => [

                view('admin.department.menu'),
                view('admin.department.group.form',[
                    "current"   => Group::find($id)
                ]),
            ]
        ]);
    }

    public function save(Request $request)
    {

        $form = $request->validate(Group::FormRules($request->get('id')), Group::FormMessage());


        if (empty($request->get('id')))
            $record = new Group();
        else
            $record = Group::find($request->get('id'));


        $record->fill($form);

        $record->show = array_key_exists('show',$form);


        $record->save();

        if(!$record->preview)
            $record->preview = $record->preview()->create([
                'name'          => $record->name,
                'type'          => 'preview',
            ]);

        if($request->file('image')){

            $record->preview->saveImage($request->file('image'));
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

        return redirect()->route('admin:department-group:list');
    }

    public function ApiDelete (Request $request,$id): JsonResponse
    {

        $item = Group::Find($id);

        if(!$item)
            return response()->json([],204);

        $item->delete();

        return response()->json(
            [
                'message' => "Группа удалена\n"
                    ."{$item->name}\n"
                    ."Восстановимо до: ".Carbon::now()->addWeek(2)->format('d.m.Y H:i')
            ]);
    }

    public function ApiToggleShow (Request $request,$id): JsonResponse
    {
        $item = Group::Find($id);

        if(!$item)
            return response()->json([],204);

        $item->show = !(bool)$item->show;
        $item->save();

        return response()->json(
            [
                'message' => ($item->show?"Группа опубликована":'Группа скрыта')."\n{$item->name}"
            ]);
    }



}
