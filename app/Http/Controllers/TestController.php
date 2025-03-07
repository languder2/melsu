<?php

namespace App\Http\Controllers;

use App\Models\Division\Division;
use App\Imports\Import;
use App\Models\Staff\Staff;
use App\Enums\DepartmentType;
use App\Models\Document;

class TestController extends Controller
{
    public function index()
    {

        return view('test.page');
    }
}
