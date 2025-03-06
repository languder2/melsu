<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
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
        return view('pages.page', [
            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'faculties',
                'element'   => null,
            ],

            'contents' => [
                view("public.education.tabs.list",['active' => 'faculties']),
                view("public.education.faculties.list",[
                    'list'  => Faculty::where('show',1)->where('type','faculty')
                        ->orderBy('order')->orderBy('name')->get(),
                ]),
            ]
        ]);

    }
    public function showAllBranch(): string
    {

        return view('pages.page', [
            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'faculties',
                'element'   => null,
            ],

            'contents' => [
                view("public.education.tabs.list",['active' => 'branch']),
                view("public.education.branch.list",[
                    'list'  => Faculty::where('show',1)->where('type','branch')
                        ->orderBy('order')->orderBy('name')->get(),
                ]),
            ]
        ]);

    }
    public function showAllDepartments(): string
    {
        $groupedItems = Department::orderBy('name')->get()->groupBy(function ($item) {
            return strtoupper(mb_substr($item->name, 0, 1, 'UTF-8')); // Первая буква в верхнем регистре
        });

        return view('pages.page', [
            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'faculties',
                'element'   => null,
            ],

            'contents' => [

                view("public.education.tabs.list",['active' => 'departments']),
                view("public.education.departments.Search",[
                    'filter'        => json_decode(session()->get('public.education.departments.Search')),
                    'faculties'     => Faculty::where('show',1)->where('type','faculty')
                        ->orderBy('name')->get()->pluck('name','code'),
                ]),
                view("public.education.departments.list",[
                    'list'  => $groupedItems,
                ]),
            ]
        ]);
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
                    'list'  => Lab::where('show',1)->orderBy('sort')->orderBy('name')->get(),
                ]),
            ]
        ]);
    }

    public function faculty($faculty = null): \Illuminate\View\View|RedirectResponse
    {

        $faculty = Faculty::where('code', $faculty)->first();

        if ($faculty === null)
            return redirect()->to(route('public:education:faculties'));

        $menu = Menu::GetMenuFaculty($faculty, page: 'about');


        return view('public.education.faculty.about',compact('faculty','menu'));


        return view('pages.page-with-menu', [
            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'faculty',
                'element'   => $faculty,
            ],

            'sidebar' => View::make('components.menu.alt_sidebar')->with([
                'menu' => &$menu,
            ])->render(),

            'contents' => [
                View::make('components.education.faculty')->with([
                    'faculty' => $faculty,
                ])->render()

            ]
        ]);



    }

    public function departments($faculty = null): string|RedirectResponse
    {

        $faculty = Faculty::where('code', $faculty)->first();

        if ($faculty === null)
            return redirect()->to(route('public:education:faculties'));

        $menu = Menu::GetMenuFaculty($faculty, page: 'departments');

        return view('pages.page-with-menu', [
            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'departments',
                'element'   => $faculty,
            ],

            'sidebar' => View::make('components.menu.alt_sidebar')->with([
                'menu' => &$menu,
            ])->render(),

            'contents' => [
                View::make('components.education.departments')->with([
                    'faculty' => $faculty,
                ])->render()
            ]
        ]);


    }

    public function department($faculty = null, $department = null): string|RedirectResponse
    {

        $faculty = Faculty::where('code', $faculty)->first();

        $department = $faculty->departments()->where('code', $department)->first();

        if (!$faculty || !$department)
            return redirect()->to(route('public:education:faculties'));

        $menu = Menu::GetMenuFaculty($faculty, page: 'departments');

        return view('pages.page-with-menu', [
            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'faculty',
                'element'   => $faculty,
            ],

            'sidebar' => View::make('components.menu.alt_sidebar')->with([
                'menu' => &$menu,
            ])->render(),

            'nobg' => true,

            'contents' => [
                View::make('components.education.department')->with([
                    'faculty' => $faculty,
                    'department' => $department,
                ])->render(),
                (new AllSpeciality($faculty->code, $department->code))->render(),
            ]
        ]);
    }

    /* public: specialities | Специальности, список  */
    public function specialities($faculty = null, $department = null): string|RedirectResponse
    {


//        $menu = Menu::GetMenuFaculty($faculty??[], page: 'specialities');

        return view("pages.page-with-menu", [
            'sidebar' => View::make('components.menu.sidebar')->with([
                'menu' => &$menu,
                'full' => false,
            ])->render(),

            'breadcrumbs' => (object)[
                'view'      => null,
                'route'     => 'specialities',
                'element'   => null,
            ],

            'nobg' => true,

            'contents' => [
                (new AllSpeciality($faculty, $department))->render(),
            ]

        ]);
    }

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
