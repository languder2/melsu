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

    public function faculties(): string
    {
        $list = Division::where('show',1)
            ->where('type',DivisionType::Faculty)
            ->orderBy('sort')
            ->orderBy('name')
            ->get()
        ;

        return view('public.education.faculties.list', compact('list'));

    }

    public function faculty($code = null): \Illuminate\View\View|RedirectResponse
    {

        $faculty = Division::where('code', $code)->orWhere('id',$code)->first();

        if ($faculty === null)
            return redirect()->to(route('public:education:faculties'));

        $menu = Menu::GetMenuFaculty($faculty, page: 'about');


        return view('public.education.faculty.about',compact('faculty','menu'));
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

    public function departments($code = null): string|RedirectResponse
    {

        $division = Division::where('code', $code)->orWhere('id',$code)->first();

        if ($division === null)
            return redirect()->to(route('public:education:faculties'));

        $menu = match($division->type){
            default => null,
            DivisionType::Faculty       => Menu::GetMenuFaculty($division, page: 'departments'),
            DivisionType::Department    => Menu::GetMenuDepartment($division, page: 'labs'),
        };

        return view('public.education.faculty.departments',compact('division','menu'));

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

        $menu = match($division->type){
            default => null,
            DivisionType::Faculty       => Menu::GetMenuFaculty($division, page: 'specialities'),
            DivisionType::Department    => Menu::GetMenuDepartment($division, page: 'specialities'),
        };

        return view('public.education.faculty.specialities',compact('division','menu'));
    }

    public function deanOffice($code = null): string|RedirectResponse
    {
        $division = Division::where('code', $code)->orWhere('id',$code)->first();

        if ($division === null)
            return redirect()->to(route('public:education:faculties'));

        $menu = Menu::GetMenuFaculty($division, page: 'dean-office');

        return view('public.education.faculty.dean-office',compact('division','menu'));
    }

    public function teachingStaff($code = null): string|RedirectResponse
    {
        $division = Division::where('code', $code)->orWhere('id',$code)->first();

        if ($division === null)
            return redirect()->to(route('public:education:faculties'));

        $menu = match($division->type){
            default => null,
            DivisionType::Faculty       => Menu::GetMenuFaculty($division, page: 'teaching-staff'),
            DivisionType::Department    => Menu::GetMenuDepartment($division, page: 'teaching-staff'),
            DivisionType::Branch        => Menu::GetMenuBranch($division, page: 'teaching-staff'),
        };

        return view('public.education.faculty.teaching-staff',compact('division','menu'));
    }

    public function showAllBranch(): string
    {

        $list = Division::where('show',1)->where('type',DivisionType::Branch)
            ->orderBy('sort')->orderBy('name')
            ->get()
        ;

        return view('public.education.branch.list', compact('list'));
    }

    public function branch($code = null): string|RedirectResponse
    {

        $division   = Division::where('code', $code)->orWhere('id',$code)->first();

        if(!$division || $division->type != DivisionType::Branch)
            return redirect()->to(route('public:education:branch:list'));

        $menu = Menu::GetMenuBranch($division,'about');

        return view('public.education.branch.about',compact('division','menu'));
    }













    public function showAllLabs(): string
    {

        return view('pages.page', [
            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'faculties',
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

    /* public: specialities | Специальности, список  */


    public function speciality(?string $speciality_code): string|RedirectResponse
    {

        $speciality = Speciality::where('code', $speciality_code)->first();

        if (!$speciality)
            return redirect()->to(route('public:education:faculties'));

        return view("pages.page", [
            'sidebar' => View::make('components.menu.sidebar')->with([
                'menu' => &$menu,
                'full' => false,
            ])->render(),

            'nobg' => true,

            'contents' => [
                (new SingleSpeciality($speciality))->render(),
            ]

        ]);
    }


}
