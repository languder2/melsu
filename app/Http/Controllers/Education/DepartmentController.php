<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Department;
use App\Models\Education\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DepartmentController extends Controller
{
    public function list(): string
    {
        $faculties      = Faculty::orderBy('order', 'desc')->where('type','faculty')->orderBy('name')->get();
        $departments    = Department::whereNull('faculty_code')->orderBy('order')->orderBy('name')->get();

        return view('admin.education.departments.page', compact('faculties','departments'));
    }

    public function form($id = null)
    {

        $current = Department::find($id);

        if(!$current)
            $current = new Department();

        $add2faculty = request()->get('faculty');
        $faculties = Faculty::pluck('name', 'code')->toArray();

        return view('admin.education.departments.form.page',
            compact('current','add2faculty','faculties'));
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

        return redirect()->route('admin:department:list');
    }

    public function delete(int $id)
    {
        $record = Department::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:department:list');
    }
}
