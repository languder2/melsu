<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Department;
use App\Models\Education\Level;
use App\Models\Education\Forms;
use App\Models\Education\Faculty;
use App\Models\Education\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SpecialityController extends Controller
{
    public function list():string
    {

        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.top_menu.education')->with([
                    'active'    => 'specialities'
                ])->render(),

                View::make('components.admin.education.specialities.header')->with([])->render(),

                View::make('components.admin.education.specialities.list')->with([
                    'list' => Faculty::orderBy('order','desc')->orderBy('name')->get(),
                ])->render(),
            ]
        ]);
    }

    public function form($id = null,)
    {

        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.education')->with([
                    'active'    => 'specialities'
                ])->render(),

                View::make('components.admin.education.specialities.form.form')->with([
                    'current'       => Speciality::find($id)?->toJSON(JSON_UNESCAPED_UNICODE),
                    'add2faculty'   => request()->get('faculty'),
                    'faculties'     => Faculty::pluck('name','code')?->toJSON(JSON_UNESCAPED_UNICODE),
                    'departments'   => Department::pluck('name','code')?->toJSON(JSON_UNESCAPED_UNICODE),
                    'levels'        => Level::pluck('name','code')?->toJSON(JSON_UNESCAPED_UNICODE),
                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {
        $form = $request->validate(Department::FormRules($request->get('id')),Department::FormMessage());

        if (empty($request->get('id')))
            $record = new Department();
        else
            $record = Department::find($request->get('id'));

        $record->fill($form);

        $record->save();

        return redirect()->route('admin:education-speciality:list');
    }

    public function delete(int $id)
    {
        $record = Department::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:education-speciality:list');
    }
}
