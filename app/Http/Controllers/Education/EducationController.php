<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Faculty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
class EducationController extends Controller
{
    public function faculties():string
    {
        $faculties = Faculty::orderBy('order','desc')->orderBy('name')->get();

        return view('pages.page-with-menu', [
//            'breadcrumbs'   => View::make('components.template.breadcrumbs')->with([
//                'current'   => array_slice($breadcrumbs, -1)[0],
//                'last'      => array_slice($breadcrumbs, -2, 1)[0],
//                'list'      => array_slice($breadcrumbs,0,count($breadcrumbs)-2),
//            ])->render(),

            'sidebar'       => View::make('components.menu.alt_sidebar')->with([
                'menu'          => Menu::GetMenuFaculties($faculties),
            ])->render(),

            'contents'      => [
                View::make('components.education.faculties')->with([
                    'list'      => $faculties,
                ])->render()
            ]
        ]);

    }

    public function faculty($faculty = null):string|RedirectResponse
    {

        $faculty = Faculty::where('code',$faculty)->first();

        if($faculty === null)
            return redirect()->to(route('public:education:faculties'));

        $menu = Menu::GetMenuFaculty($faculty, page: 'about');

        return view('pages.page-with-menu', [
//            'breadcrumbs'   => View::make('components.template.breadcrumbs')->with([
//                'current'   => array_slice($breadcrumbs, -1)[0],
//                'last'      => array_slice($breadcrumbs, -2, 1)[0],
//                'list'      => array_slice($breadcrumbs,0,count($breadcrumbs)-2),
//            ])->render(),

            'sidebar'       => View::make('components.menu.alt_sidebar')->with([
                'menu'          => &$menu,
            ])->render(),

            'contents'      => [
                View::make('components.education.faculty')->with([
                    'faculty'      => $faculty,
                ])->render()
            ]
        ]);


    }

    public function departments($faculty = null):string|RedirectResponse
    {

        $faculty = Faculty::where('code',$faculty)->first();

        if($faculty === null)
            return redirect()->to(route('public:education:faculties'));

        $menu = Menu::GetMenuFaculty($faculty, page: 'departments');

        return view('pages.page-with-menu', [
//            'breadcrumbs'   => View::make('components.template.breadcrumbs')->with([
//                'current'   => array_slice($breadcrumbs, -1)[0],
//                'last'      => array_slice($breadcrumbs, -2, 1)[0],
//                'list'      => array_slice($breadcrumbs,0,count($breadcrumbs)-2),
//            ])->render(),

            'sidebar'       => View::make('components.menu.alt_sidebar')->with([
                'menu'          => &$menu,
            ])->render(),

            'contents'      => [
                View::make('components.education.departments')->with([
                    'faculty'      => $faculty,
                ])->render()
            ]
        ]);


    }

    public function department($faculty = null,$department = null):string|RedirectResponse
    {

        $faculty = Faculty::where('code',$faculty)->first();

        $department = $faculty->departments()->where('code',$department)->first();

        if(!$faculty || !$department)
            return redirect()->to(route('public:education:faculties'));

        $menu = Menu::GetMenuFaculty($faculty, page: 'departments');

        return view('pages.page-with-menu', [
//            'breadcrumbs'   => View::make('components.template.breadcrumbs')->with([
//                'current'   => array_slice($breadcrumbs, -1)[0],
//                'last'      => array_slice($breadcrumbs, -2, 1)[0],
//                'list'      => array_slice($breadcrumbs,0,count($breadcrumbs)-2),
//            ])->render(),

            'sidebar'       => View::make('components.menu.alt_sidebar')->with([
                'menu'          => &$menu,
            ])->render(),

            'contents'      => [
                View::make('components.education.department')->with([
                    'faculty'       => $faculty,
                    'department'    => $department,
                ])->render()
            ]
        ]);
    }

    public function specialities($faculty = null):string|RedirectResponse
    {

        if($faculty !== null){

        $faculty = Faculty::where('code',$faculty)->first();

        if(!$faculty)
            return redirect()->to(route('public:education:faculties'));
        }


        $menu = Menu::GetMenuFaculty($faculty, page: 'specialities');

        return view('pages.page-with-menu', [
//            'breadcrumbs'   => View::make('components.template.breadcrumbs')->with([
//                'current'   => array_slice($breadcrumbs, -1)[0],
//                'last'      => array_slice($breadcrumbs, -2, 1)[0],
//                'list'      => array_slice($breadcrumbs,0,count($breadcrumbs)-2),
//            ])->render(),

            'sidebar'       => View::make('components.menu.alt_sidebar')->with([
                'menu'          => &$menu,
            ])->render(),

            'nobg'          => true,

            'contents'      => [
                View::make('components.education.specialities.filter')->with([
                    'faculty'       => $faculty,
                ])->render(),
                View::make('components.education.specialities.list')->with([
                    'list'          => $faculty->specialities,
                    'faculty'       => $faculty,
                ])->render(),
            ]
        ]);
    }

}
