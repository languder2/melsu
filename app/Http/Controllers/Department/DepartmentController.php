<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use App\Models\Department\Group;
use App\Models\Menu\Menu;
use App\Models\Staff\Affiliation as StaffAffiliation;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class DepartmentController extends Controller
{
    public function adminList($code = 'without-group'): string
    {

        $departments = Department::whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('pages.admin', [
            'contents' => [
                View('admin.department.menu'),

                View('admin.department.department.header'),
                View('admin.department.department.list',[
                    'list'  => $departments,
                ]),
            ]
        ]);
    }

    public function form(Request $request,$id = null): string
    {

        if($id)
            $parents =  Department::orderBy('name')->where('id','!=',$id)->get();
        else
            $parents =  Department::orderBy('name')->get();

        return view('pages.admin', [
            'contents' => [
                View('admin.department.menu'),
                View('admin.department.department.form',[
                        'current'   => Department::find($id),
                        'parents'   => $parents->pluck('name','id'),
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

        $form = $request->validate(Department::FormRules($request->get('id')), Department::FormMessage());

        if (empty($request->get('id')))
            $record = new Department();
        else
            $record = Department::find($request->get('id'));

        $record->fill($form);

        $record->show = array_key_exists('show',$form);

        $record->save();


        if(array_key_exists('chief',$form)){
            if($form['chief'] && Staff::find($form['chief'])){
                $chief = $record->chief;

                if(!$chief)
                    $chief = $record->chief()->create([
                        'type'      => 'chief',
                    ]);

                $chief->staff_id    = $form['chief'];
                $chief->post        = $form['chief_post'];
                $chief->post_alt    = $form['chief_post_alt'];

                $chief->save();
            }
        }

        if(array_key_exists('staffs',$form)){
            foreach ($form['staffs'] as $affiliation_id=>$staff) {
                if(!$staff['full_name']) continue;

                $staffCard = Staff::Find($staff['staff_id']);

                if(!$staffCard){
                    $fullName = explode(' ',$staff['full_name']);
                    $newStaff = Staff::create([
                        'lastname'      => $fullName[0] ?? null,
                        'firstname'     => @$fullName[1] ?? null,
                        'middle_name'   => @$fullName[2] ?? null,
                    ]);

                    $staff['staff_id'] = $newStaff->id;
                }

                $item = $record->staffs()->find($affiliation_id);

                if(!$item)
                    $item = $record->staffs()->create([
                        'type'  => 'staff',
                    ]);

                $item->fill($staff);

                $item->save();
            }
        }

        if($request->file('image')){
            $record->preview->saveImage($request->file('image'));
            $record->preview->reference_id = null;
            $record->preview->save();
        }
        elseif($form['preview']){
            $record->preview->name = $record->name;
            $record->preview->getReferenceID($form['preview']);
            $record->preview->save();
        }

        if(array_key_exists('sections',$form)){
            foreach ($form['sections'] as $section_id=>$section) {
                if(!$section['title']) continue;

                $item = $record->sections()->find($section_id);

                if(!$item)
                    $item = $record->sections()->create(['title'=> 'new']);

                $item->fill($section);

                $item->show         = array_key_exists('show',$section);
                $item->show_title   = array_key_exists('show_title',$section);

                $item->save();
            }
        }

        return redirect()->route('admin:department:list');
    }

    public function delete(int $id)
    {
        $record = Department::find($id);

        if (!is_null($record))
            $record->delete();

        $list = Department::where('parent_id',$id)->get();

        foreach ($list as $item)
            $item->fill(['parent_id' => null])->save();

        return redirect()->route('admin:department:list');
    }


    public function show(Request $request, $code = null)
    {

        $department = Department::where('code', $code)->orWhere('id',(int)$code)->first();

//        if (!$department || !$department->show)
        if (!$department)
            return redirect()->route('pages:main');

        if (strtolower($department->code) === 'rectorate')
            $pageContent = View::make('components.department.rectorate')->with([
                'department' => $department,
            ])->render();
        else
            $pageContent = View::make('components.department.single')->with([
                'department' => $department,
            ])->render();


        return view("pages.page-with-menu", [
            'sidebar' => view('Public.Menu.AsideTree',[
                'menu' => Menu::where('code','university')->first(),
            ]),

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

//        $pageContent = (new \App\View\Components\Department\All())->render();



        $pageContent = view('Public.Departments.List',[
            'department'    =>  Department::where('code', 'rectorate')->first(),
        ]);

        return view("pages.page-with-menu", [
            'sidebar' => view('Public.Menu.AsideTree',[
                'menu' => Menu::where('code','university')->first(),
            ]),

            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'departments',
                'element'   => null,
            ],


            'nobg' => true,

            'news' => false,

            'contents' => [
                $pageContent
            ]
        ]);
    }


    public function ApiVacatePosition(Request $request,$affiliation_id = null)
    {

        $item = StaffAffiliation::find($affiliation_id);

        if($item)
            $item->delete();

        return response()->json(
            [
                'message' => "Вакансия освобождена"
            ]);
    }

}
