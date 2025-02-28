<?php

namespace App\Http\Controllers;

use App\Models\Department\Department;
use App\Imports\Import;

class TestController extends Controller
{
    public function index()
    {

        $array = (new Import);

        dump();

    }
}
