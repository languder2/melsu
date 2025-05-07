<?php

namespace App\Http\Controllers\Education;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Education\Department;
use App\Models\Education\Faculty;
use App\Models\Education\Lab;
use App\Models\Education\Speciality;
use App\Models\Menu\Menu;
use App\View\Components\Specialities\{AllSpeciality, Single as SingleSpeciality};
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class EducationController extends Controller
{
    public function institutes(): \Illuminate\View\View
    {
        $list = Division::where('show',true)
            ->where('type',DivisionType::Institute)
            ->orderBy('sort')
            ->orderBy('name')
            ->get()
        ;

        return view('public.education.institutes.list', compact('list'));
    }
    public function faculties(): \Illuminate\View\View
    {
        $list = Division::where('show',1)
            ->where('type',DivisionType::Faculty)
            ->orderBy('sort')
            ->orderBy('name')
            ->get()
        ;

        return view('public.education.faculties.list', compact('list'));
    }

    public function division(string $type,?Division $division = null,?string $section = null, ?string $op = null )
    {

        if(!$division)
            return redirect()->to(route('public:education:faculties'));

        return view('public.education.page',compact('division','section','type','op'));
    }


    public function showAllDepartments(): string
    {
        $list = Division::where('show',1)->where('type',DivisionType::Department)
            ->orderBy('name')->get()
            ->groupBy(function ($item) {
                return strtoupper(mb_substr($item->alt_name, 0, 1, 'UTF-8'));
            });

        $filter     = json_decode(session()->get('public.education.departments.search'));
        $faculties  = Division::where('show',1)
            ->where('type',DivisionType::Faculty)
            ->orderBy('sort')
            ->orderBy('name')
            ->get()
            ->pluck('name','code')
        ;

        return view('public.education.departments.list', compact('list','faculties','filter'));
    }

    public function department($code = null): string|RedirectResponse
    {
        $division   = Division::where('code', $code)->orWhere('id',$code)->first();

        if(!$division || $division->type != DivisionType::Department)
            return redirect()->to(route('public:education:faculties'));

        $menu = Menu::GetMenuDepartment($division,'about');

        return view('public.education.departments.about',compact('division','menu'));
    }

    public function specialities($code = null): string|RedirectResponse
    {
        $division = Division::where('code', $code)->orWhere('id',$code)->first();

        if ($division === null)
            return redirect()->to(route('public:education:faculties'));

        return view('public.education.faculty.specialities',compact('division'));
    }


    public function showAllBranch(): string
    {

        $list = Division::where('show',1)->where('type',DivisionType::Branch)
            ->orderBy('sort')->orderBy('name')
            ->get()
        ;

        return view('public.education.branch.list', compact('list'));
    }

    public function showAllLabs(): string
    {

        return view('pages.page', [
            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'labs',
                'element'   => null,
            ],

            'contents' => [
                view("public.education.tabs.list",['active' => 'labs']),
                view("public.education.labs.list",[
                    'list'  => Division::where('type',DivisionType::Lab)->where('show',1)->orderBy('sort')->orderBy('name')->get(),
                ]),
            ]
        ]);
    }

}
