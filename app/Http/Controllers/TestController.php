<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education\Faculty;

class TestController extends Controller
{
    public function index()
    {
        $list= Faculty::all();

    }

    public function save(Request $request)
    {
        $request->validate(['test2'=>'required']);
    }
}
