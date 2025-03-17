<?php

namespace App\Http\Controllers\Education;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Education\Department;
use App\Models\Education\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DepartmentController extends Controller
{
    public function list(): string
    {
        $list   = Division::where('type',DivisionType::Faculty)->orderBy('sort')->orderBy('name')->get();

        return view('admin.education.departments', compact('list'));
    }

}
