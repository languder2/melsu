<?php

namespace App\Http\Controllers;

use App\Models\Department\Department;
use App\Imports\Import;
use App\Models\Staff\Staff;

class TestController extends Controller
{
    public function index()
    {

        $rector = Staff::where('alias','rector')->first();
    }
}
