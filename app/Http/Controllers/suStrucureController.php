<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\suStructure;
use App\View\Components\admin\structure\form as structureForm;


class suStrucureController extends Controller
{
    public function adminList()
    {
        return view('pages.admin',[
            'contents'  => [
                view('admin.structure.list',[
                    'list'          => suStructure::getListByGroups(),
                ])->render(),
            ]
        ]);
    }

    public function form(?int $id=null)
    {

        if(!is_null($id))
            $current = suStructure::find($id);

        $contents       = [];

        $form = new structureForm();


        $contents[]     = $form->render()->with([
            'groups'    => suStructure::getGroupsForSelect(),
            'form'      => @$current,
        ]);

        return view('pages.admin',[
            'contents'  => $contents
        ]);
    }

    public function save(Request $request):RedirectResponse
    {
        $form = $request->validate(suStructure::$FormRules,suStructure::$FormMessage);

        if(empty($form['sort'])){
            $last           = suStructure::where('ssu_group',$form['ssu_group'])->orderBy('sort','desc')->first();

            if(is_null($last))
                $form['sort'] = 10;

            else
                $form['sort']   = $last->sort+10;
        }

        if(empty($request->get('id')))
            $record = new suStructure($form);
        else{
            $record = suStructure::find($request->get('id'));
            $record->fill($form);
        }

        $record->save();

        return redirect()->route('admin:structure');
    }

    public function delete(int $id):RedirectResponse
    {
        $record = suStructure::find($id);

        if(!is_null($record))
            $record->delete();

        return redirect()->route('admin:structure');
    }

}
