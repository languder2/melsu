<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Department;
use App\Models\Education\Faculty;
use App\Models\Education\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class LabsController extends Controller
{
    public function AdminList(): string
    {

        return view('pages.admin', [
            'contents' => [

                view('admin.education.menu'),
                view('admin.education.labs.header'),
                view('admin.education.labs.list')->with([
                    'list'  => Lab::orderBy('sort')->orderBy('name')->get(),
                ]),
            ]
        ]);
    }
    public function form($id = null)
    {
        return view('pages.admin', [
            'contents' => [
                view('admin.education.menu'),

                view('admin.education.labs.form',[
                    'current' => Lab::find($id),
                    'departments' => Department::orderBy('name')->get()->pluck('name', 'id'),
                ]),
            ]
        ]);
    }

    public function save(Request $request)
    {


        $form = $request->validate(Lab::FormRules($request->get('id')), Lab::FormMessage());

        if (empty($request->get('id')))
            $record = new Lab();
        else
            $record = Lab::find($request->get('id'));

        $record->fill($form);

        $record->show = array_key_exists('show', $form);

        $record->save();

        if($request->file('image')){
            $record->preview->saveImage($request->file('image'));
            $record->preview->reference_id = null;
            $record->preview->save();
        }
        elseif($request->get('preview')){
            $record->preview->name = $record->name;
            $record->preview->getReferenceID($request->get('preview'));
            $record->preview->save();
        }

        if($request->get('department_id')){
            $affiliation = Department::find($request->get('department_id'));
            if($affiliation)
                $record->relation()->associate($affiliation)->save();
        }

        return redirect()->route('admin:education:labs:list');
    }

    public function delete(int $id)
    {
        $record = Department::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:education-department:list');
    }
}
