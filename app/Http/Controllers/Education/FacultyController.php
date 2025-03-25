<?php

namespace App\Http\Controllers\Education;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use Illuminate\View\View;

class FacultyController extends Controller
{
    public function list():View
    {
        $list = Division::where('type',DivisionType::Faculty)
            ->orderBy('sort')->orderBy('name')
            ->get();

        return view('admin.education.faculties', compact('list'));
    }

}
