<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Faculty;
use Illuminate\Support\Facades\View;

class FacultyController extends Controller
{
    public function list():string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.top_menu.education')->with([
                    'active'    => 'faculties'
                ])->render(),

                View::make('components.admin.education.faculties.header')->with([])->render(),

                View::make('components.admin.education.faculties.list')->with([
                    'list' => Faculty::all(),
                ])->render(),
            ]
        ]);
    }
}
