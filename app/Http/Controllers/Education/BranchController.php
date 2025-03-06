<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\Education\Faculty;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Education\Branch;

class BranchController extends Controller
{
    public function admin():View
    {
        return view('admin.education.branches.page');
    }

    public function form($id = null)
    {
        return view('admin.education.branches.form.page',[
            'current' => Faculty::find($id),
        ]);
    }

    public function public():View
    {
        return view('admin.education.branches.page');
    }
}
