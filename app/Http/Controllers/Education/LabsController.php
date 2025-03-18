<?php

namespace App\Http\Controllers\Education;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Education\Department;
use App\Models\Education\Faculty;
use App\Models\Education\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class LabsController extends Controller
{
    public function AdminList(): string
    {
        $list   = Division::where('type',DivisionType::Lab)->orderBy('sort')->orderBy('name')->get();

        return view('admin.education.labs', compact('list'));
    }

}
