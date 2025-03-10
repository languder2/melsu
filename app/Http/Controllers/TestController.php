<?php

namespace App\Http\Controllers;

use App\Models\Division\Division;
use App\Imports\Import;
use App\Models\Staff\Staff;
use App\Enums\DepartmentType;
use App\Models\Contact;
use App\Enums\ContactType;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
            return view('test.page');
    }

    public function save(Request $request)
    {
        $request->validate(['test2'=>'required']);
    }
}
