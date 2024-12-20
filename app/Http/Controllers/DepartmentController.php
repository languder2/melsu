<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\{Department,DepartmentSection,DepartmentDocument,Staff};

class DepartmentController extends Controller
{
    public function adminList(): string
    {
        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.department.header')->with([])->render(),

                View::make('components.admin.department.list')->with([
                    'list' => [],
                ])->render(),
            ]
        ]);
    }
    public function form($id = null): string
    {

        return view('pages.admin', [
            'contents' => [
                View::make('components.admin.department.form')->with([
                    'current' => Staff::getByID($id),
                ])->render(),
            ]
        ]);
    }


}
