<?php

namespace App\Http\Controllers\Education;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Division\Division;
use App\Models\Education\Faculty;
use App\Models\Menu\Menu;
use App\Models\Staff\Affiliation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
