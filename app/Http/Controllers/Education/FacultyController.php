<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FacultyController extends Controller
{
    public function list(): string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.top_menu.education')->with([
                    'active' => 'faculties'
                ])->render(),

                View::make('components.admin.education.faculties.header')->with([])->render(),

                View::make('components.admin.education.faculties.list')->with([
                    'list' => Faculty::all(),
                ])->render(),
            ]
        ]);
    }

    public function form($id = null)
    {
        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.top_menu.education')->with([
                    'active' => 'faculties'
                ])->render(),

                View::make('components.admin.education.faculties.form')->with([
                    'current' => Faculty::find($id),
                ])->render(),
            ]
        ]);
    }

    public function save(Request $request)
    {
        $form = $request->validate(Faculty::FormRules($request->get('id')), Faculty::FormMessage());

        if (empty($request->get('id')))
            $record = new Faculty();
        else
            $record = Faculty::find($request->get('id'));

        $record->fill($form);

        $record->save();

        return redirect()->route('admin:education-faculty:list');
    }

    public function delete(int $id)
    {
        $record = Faculty::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:education-faculty:list');
    }
}
