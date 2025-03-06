<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use App\Models\Education\Faculty;
use App\Models\Education\Department as EducationDepartment;
use App\Models\Education\Lab;
use App\Models\Menu\Menu;
use App\Models\Staff\Affiliation;
use App\Models\Staff\Staff;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


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

    public function form(Request $request,$id = null): View|RedirectResponse
    {
        $parents = Department::query();


        if($department = Department::find($id))
            $parents->where('id','!=',$id);
        else
            return redirect()->route('admin:department:list');

        $parents = $parents->orderBy('name')->get()->pluck('name','id');

        return view('admin.department.department.form.page',[
            'current'   => $department,
            'parents'   => $parents,
        ]);
    }
    public function save(Request $request)
    {

        $form = $request->validate(Department::FormRules($request->get('id')), Department::FormMessage());

        if (empty($request->get('id')))
            $record = new Department();
        else
            $record = Department::find($request->get('id'));

        if($request->has('coordinator'))
            $record->coordinator_id = $request->get('coordinator')['staff_id'] ?? null;

        $record->fill($form);

        $record->show = array_key_exists('show', $form);

        if(request()->get('identity')){
            $identity = explode(':',$request->get('identity'));

            switch ($identity[0]) {
                case 'faculty':
                    $identity = Faculty::find($identity[1]);
                break;

                case 'department':
                    $identity = EducationDepartment::find($identity[1]);
                break;

                case 'lab':
                    $identity = Lab::find($identity[1]);
                break;

                default:
                    $identity = null;
                break;
            }

            if($identity)
                $record->relation()->associate($identity)->save();
        }

        $record->show = array_key_exists('show',$form);

        $record->save();


        if(array_key_exists('chief',$form))
            Affiliation::ProcessingChief($record,$form['chief']);


        if(array_key_exists('staffs',$form))
            foreach ($form['staffs'] as $aID=>$staff)
                Affiliation::ProcessingStaff($record,$aID,$staff);

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


    public function show(Request $request, $code = null):View|RedirectResponse
    {

        $department = Department::where('code', $code)->orWhere('id',(int)$code)->first();

//        if (!$department || !$department->show)
        if (!$department)
            return redirect()->route('pages:main');

        if (strtolower($department->code) === 'rectorate')
            $pageContent = \Illuminate\Support\Facades\View::make('components.department.rectorate')->with([
                'department' => $department,
            ])->render();
        else
            $pageContent = \Illuminate\Support\Facades\View::make('components.department.single')->with([
                'department' => $department,
            ])->render();


        return view("pages.page-with-menu", [
            'sidebar' => view('public.menu.aside-tree',[
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

    public function showList(Request $request)
    {
        return view('public.departments.page',[
            'department'    => Department::where('code', 'rectorate')->first(),
            'menu'          => Menu::where('code','university')->first(),
            'depth'         => 0
        ]);
    }


    public function ApiVacatePosition(Request $request,$affiliation_id = null): JsonResponse
    {

        $item = Affiliation::find($affiliation_id);

        if($item)
            $item->delete();

        return response()->json(
            [
                'message' => "Вакансия освобождена"
            ]);
    }


    public function PublicSearchResult(Request $request)
    {
        $department = Department::where('code', 'rectorate')->first();

        if($request->has('search'))
            Department::search($department,$request->get('search'));
        else
            Department::search($department,'Отдел по работе с обучающимися');

        return view('public.departments.list',[
            'department'    => $department,
            'depth'         => 0
        ]);

    }

}
