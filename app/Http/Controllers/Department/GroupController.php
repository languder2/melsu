<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\Department\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function list()
    {
        return view('pages.admin', [
            'contents' => [
                View('admin.department.department.header'),
                View('admin.department.department.list',[
                    'list'      => Group::paginate(20),
                ]),
            ]
        ]);
    }
}
