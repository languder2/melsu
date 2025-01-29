<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Faculty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class EducationController extends Controller
{
    public function faculties():string
    {
        $faculties = Faculty::orderBy('order','desc')->orderBy('name')->get();

        $menu = [
            (object)[
                'name'      => "Факультеты",
                'link'      => url('faculties'),
                'active'    => true,
                'subs'      => [],
            ],
        ];

        foreach ($faculties as $faculty) {
            $menu[0]->subs[] = (object)[
                'name'      => $faculty->name,
                'link'      => url("faculties/{$faculty->code}"),
                'active'    => false,
                'subs'      => [],
            ];
        }

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

        $menu = [
            (object)[
                'name'      => $faculty->name,
                'link'      => url("faculties/{$faculty->code}"),
                'active'    => true,
                'subs'      => [
                    (object)[
                        'name'      => "О факультете",
                        'link'      => url("faculties/{$faculty->code}"),
                        'active'    => true,
                    ],
                    (object)[
                        'name'      => "Деканат",
                        'link'      => url("faculties/{$faculty->code}/staffs"),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Кафедры",
                        'link'      => url("faculties/{$faculty->code}/departments"),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Направление подготовки",
                        'link'      => url("faculties/{$faculty->code}/specialities"),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Поступающим",
                        'link'      => url('incoming'),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Наука",
                        'link'      => url('science'),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Партнеры и выпускники",
                        'link'      => url('partner'),
                        'active'    => false,
                    ],
                ],
            ],
        ];

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

        $menu = [
            (object)[
                'name'      => $faculty->name,
                'link'      => url("faculties/{$faculty->code}"),
                'active'    => true,
                'subs'      => [
                    (object)[
                        'name'      => "О факультете",
                        'link'      => url("faculties/{$faculty->code}"),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Деканат",
                        'link'      => url("faculties/{$faculty->code}/staffs"),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Кафедры",
                        'link'      => url("faculties/{$faculty->code}/departments"),
                        'active'    => true,
                    ],
                    (object)[
                        'name'      => "Направление подготовки",
                        'link'      => url("faculties/{$faculty->code}/specialities"),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Поступающим",
                        'link'      => url('incoming'),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Наука",
                        'link'      => url('science'),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Партнеры и выпускники",
                        'link'      => url('partner'),
                        'active'    => false,
                    ],
                ],
            ],
        ];

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

        $menu = [
            (object)[
                'name'      => $faculty->name,
                'link'      => url("faculties/{$faculty->code}"),
                'active'    => true,
                'subs'      => [
                    (object)[
                        'name'      => "О факультете",
                        'link'      => url("faculties/{$faculty->code}"),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Деканат",
                        'link'      => url("faculties/{$faculty->code}/staffs"),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Кафедры",
                        'link'      => url("faculties/{$faculty->code}/departments"),
                        'active'    => true,
                    ],
                    (object)[
                        'name'      => "Направление подготовки",
                        'link'      => url("faculties/{$faculty->code}/specialities"),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Поступающим",
                        'link'      => url('incoming'),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Наука",
                        'link'      => url('science'),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Партнеры и выпускники",
                        'link'      => url('partner'),
                        'active'    => false,
                    ],
                ],
            ],
        ];

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

        $faculty = Faculty::where('code',$faculty)->first();

        if(!$faculty)
            return redirect()->to(route('public:education:faculties'));

        $menu = [
            (object)[
                'name'      => $faculty->name,
                'link'      => url("faculties/{$faculty->code}"),
                'active'    => true,
                'subs'      => [
                    (object)[
                        'name'      => "О факультете",
                        'link'      => url("faculties/{$faculty->code}"),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Деканат",
                        'link'      => url("faculties/{$faculty->code}/staffs"),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Кафедры",
                        'link'      => url("faculties/{$faculty->code}/departments"),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Направление подготовки",
                        'link'      => url("faculties/{$faculty->code}/specialities"),
                        'active'    => true,
                    ],
                    (object)[
                        'name'      => "Поступающим",
                        'link'      => url('incoming'),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Наука",
                        'link'      => url('science'),
                        'active'    => false,
                    ],
                    (object)[
                        'name'      => "Партнеры и выпускники",
                        'link'      => url('partner'),
                        'active'    => false,
                    ],
                ],
            ],
        ];

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
                View::make('components.education.specialities')->with([
                    'faculty'       => $faculty,
                ])->render()
            ]
        ]);
    }

}



//$faculty_code = null,$department_code = null,$speciality_code = null
