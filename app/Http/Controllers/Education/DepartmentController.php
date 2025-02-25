<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Department;
use App\Models\Education\DepartmentType;
use App\Models\Education\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DepartmentController extends Controller
{
    public function list($type = 'departments'): string
    {

        $faculties = Faculty::orderBy('order', 'desc')
            ->where('type','faculty')
            ->orderBy('name')->get();

        $departments = Department::whereNull('faculty_code')->where('type_code','department')->orderBy('order')->orderBy('name')->get();

        $labs = Department::where('type_code','lab')->orderBy('order')->orderBy('name')->get();

        return view('pages.admin', [
            'contents' => [

                view('admin.education.menu'),

                view('admin.education.departments.header'),
                view('admin.education.departments.list')->with([
                    'faculties'     => $faculties,
                    'departments'   => $departments,
                    'labs'          => $labs,
                ]),
            ]
        ]);
    }

    public function form($id = null)
    {

        $current= Department::find($id);

        $departments = $current
                ?$current->faculty->departments->where('type_code','department')->pluck('name', 'code')->toArray()
                :Department::where('type_code','department')->pluck('name', 'code')?->toArray();

        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.education')->with([
                    'active' => 'departments'
                ])->render(),

                View::make('components.admin.education.departments.form')->with([
                    'current' => Department::find($id),
                    'add2faculty' => request()->get('faculty'),
                    'faculties' => Faculty::pluck('name', 'code')->toArray(),
                    'departments' => $departments,
                    'types' => DepartmentType::pluck('name', 'code')->toArray(),
                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {

        $form = $request->validate(Department::FormRules($request->get('id')), Department::FormMessage());

        if (empty($request->get('id')))
            $record = new Department();
        else
            $record = Department::find($request->get('id'));

        $record->fill($form);

        $record->save();

        return redirect()->route('admin:education-department:list');
    }

    public function delete(int $id)
    {
        $record = Department::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:education-department:list');
    }
}
