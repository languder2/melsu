<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\{Department,DepartmentSection,DepartmentDocument,Staff};

class DepartmentController extends Controller
{
    public function adminList(): string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.department.header')->with([])->render(),

                View::make('components.admin.department.list')->with([
                    'list' => [],
                ])->render(),
            ]
        ]);
    }

    public function form($id = null): string
    {

        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.department.form.form')->with([
                    'current' => Staff::getByID($id),
                    'staffs' => Staff::getListForSelect(),
                ])->render(),
            ]
        ]);
    }

    public function addContentSection($i = null): string
    {
        return View::make('components.admin.department.form.content')->with([
            'i' => $i,
        ])->render();
    }

    public function addStaff($i = null): string
    {
        return View::make('components.admin.department.form.select-staff')->with([
            'i'             => $i,
            'list'          => Staff::getListForSelect(),
            'keyID'         => "id",
            'field'         => "fio",
            'placeholder'   => "Выбрать сотрудника"
        ])->render();
    }

    public function addDocument2Form($i = null): string
    {
        return View::make('components.admin.department.form.document-add-block')->with([
            'i'             => $i,
        ])->render();
    }


    public function save(Request $request)
    {



        $form = $request->validate(Department::$FormRules,Department::$FormMessage);

        if (empty($request->get('id')))
            $record = new Staff();
        else
            $record = Staff::find($request->get('id'));

/**
        if(is_array($form['works']))
            $form['works'] =
                array_values(array_filter($form['works'],function ($work){return !empty($work['post']);}));

        if(count($form['works']))
            $form['works'] = json_encode(
                $form['works'],
                JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_NUMERIC_CHECK|JSON_PRETTY_PRINT
            );

        else
            $form['works'] = null;
        /**/

        $record->fill($form);

//        $record->save();
        dd($form);
        return redirect()->route('admin:staff');
    }
}
