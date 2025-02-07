<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\{Department,DepartmentSection,DepartmentDocument,DepartmentStaff};
use App\Models\Staff;
use App\Models\Department\Department as Department2;

class DepartmentController extends Controller
{
    public function adminList(): string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.department.header')->with([])->render(),

                View::make('components.admin.department.list')->with([
                    'list' => Department::AdminList(),
                ])->render(),
            ]
        ]);
    }

    public function form($id = null): string
    {

        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.department.form.form')->with([
                    'current' => Department::getByID($id),
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

        $form = $request->validate(Department::FormRules($request->get('id')),Department::$FormMessage);

        if (empty($request->get('id')))
            $record = new Department();
        else
            $record = Department::find($request->get('id'));

        $record->fill($form);

        if(empty($form['chief_name'])){
            $record->chief_post = null;
            $record->chief      = null;
        }

        $record->save();

        if(isset($form['sections']) && is_array($form['sections']))
            DepartmentSection::AddInDepartment($record->id,$form['sections']);

        if(isset($form['staffs']) && is_array($form['staffs']))
            DepartmentStaff::AddInDepartment($record->id,$form['staffs']);

        return redirect()->route('admin:department');
    }

    public function delete(int $id)
    {
        $record = Department::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:department');
    }


    public function show($code = null)
    {


        $department     = Department2::where('alias', $code)->first();

        if(!$department)
            $department = Department2::find((int)$code);

        if(!$department)
            return redirect()->route('pages:main');

        if($code === 'rectorate')
            $pageContent = View::make('components.department.rectorate')->with([
                'department' => $department,
            ])->render();
        else
            $pageContent = View::make('components.department.single')->with([
                'department' => $department,
            ])->render();



        return view("pages.page-with-menu", [
            'sidebar'       => View::make('components.menu.sidebar')->with([
                'menu'          => &$menu,
                'full'          => false,
            ])->render(),

            'nobg'          => true,

            'news'          =>  false,

            'contents'      => [
                $pageContent
            ]
        ]);
    }

    public function showList()
    {

        $pageContent = (new \App\View\Components\Department\All())->render();

        return view("pages.page-with-menu", [
            'sidebar'       => View::make('components.menu.sidebar')->with([
                'menu'          => &$menu,
                'full'          => false,
            ])->render(),

            'nobg'          => true,

            'news'          =>  false,

            'contents'      => [
                $pageContent
            ]
        ]);
    }

}
