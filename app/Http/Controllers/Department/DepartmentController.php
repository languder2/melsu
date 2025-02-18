<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\{Department as OldDepartment, DepartmentSection, DepartmentStaff};
use App\Models\Menu;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Department\Department;
use App\Models\Department\Group;


class DepartmentController extends Controller
{
    public function adminList($code = 'without-group'): string
    {

        $group= Group::where('alias',$code)->orWhere('id',$code)->first();

        $departments =
            (
                ($code !== 'without-group')
                    ? $group->departments()
                    : Department::whereNull('group_id')
            )->whereNull('parent_id')->get();

        return view('pages.admin', [
            'contents' => [
                View('admin.department.menu',[
                    'list'  => Group::orderBy('order')->orderBy('name')->get(),
                ]),
                View('admin.department.department.header',[
                    'group' => $group,
                ]),
                View('admin.department.department.list',[
                    'list'      => $departments,
                ]),
            ]
        ]);
    }

    public function form(Request $request,$id = null): string
    {

        return view('pages.admin', [
            'contents' => [
                View('admin.department.department.form',[
                        'current'   => Department::find($id),
                        'groups'    => Group::orderBy('order')->orderBy('name')->get(),
                        'group'     => $request->get('group'),
                ]),
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
            'i' => $i,
            'list' => Staff::getListForSelect(),
            'keyID' => "id",
            'field' => "fio",
            'placeholder' => "Выбрать сотрудника"
        ])->render();
    }

    public function addDocument2Form($i = null): string
    {
        return View::make('components.admin.department.form.document-add-block')->with([
            'i' => $i,
        ])->render();
    }

    public function save(Request $request)
    {

        $form = $request->validate(OldDepartment::FormRules($request->get('id')), OldDepartment::$FormMessage);

        if (empty($request->get('id')))
            $record = new Department();
        else
            $record = OldDepartment::find($request->get('id'));

        $record->fill($form);

        if (empty($form['chief_name'])) {
            $record->chief_post = null;
            $record->chief = null;
        }

        $record->save();

        if (isset($form['sections']) && is_array($form['sections']))
            DepartmentSection::AddInDepartment($record->id, $form['sections']);

        if (isset($form['staffs']) && is_array($form['staffs']))
            DepartmentStaff::AddInDepartment($record->id, $form['staffs']);

        return redirect()->route('admin:department');
    }

    public function delete(int $id)
    {
        $record = OldDepartment::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:department');
    }


    public function show(Request $request, $code = null)
    {

        $department = Department2::where('alias', $code)->first();

        if (!$department)
            $department = Department2::find((int)$code);

        if (!$department)
            return redirect()->route('pages:main');

        if (strtolower($department->alias) === 'rectorate')
            $pageContent = View::make('components.department.rectorate')->with([
                'department' => $department,
            ])->render();
        else
            $pageContent = View::make('components.department.single')->with([
                'department' => $department,
            ])->render();


        return view("pages.page-with-menu", [
            'menu' => Menu::getMenuFromMain(
                ($department->alias==='rectorate')?$request->path():route('public:department:list')
            ),

            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'department',
                'element'   => $department,
            ],

            'nobg' => true,

            'news' => false,

            'contents' => [
                $pageContent
            ]
        ]);
    }

    public function showList(Request $request):string
    {

        $pageContent = (new \App\View\Components\Department\All())->render();

        return view("pages.page-with-menu", [
            'sidebar' => View::make('components.menu.sidebar')->with([
                'menu' => &$menu,
                'full' => false,
            ])->render(),

            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'departments',
                'element'   => null,
            ],


            'menu' => Menu::getMenuFromMain(route('public:department:list')),

            'nobg' => true,

            'news' => false,

            'contents' => [
                $pageContent
            ]
        ]);
    }

}
