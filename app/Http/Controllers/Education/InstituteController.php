<?php

namespace App\Http\Controllers\Education;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use Illuminate\View\View;

class InstituteController extends Controller
{
    public function admin():View
    {
        $list = Division::where('type',DivisionType::Institute)
            ->orderBy('sort')->orderBy('name')
            ->get();

        return view('admin.education.institutes', compact('list'));
    }

}
