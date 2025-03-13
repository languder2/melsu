<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education\Faculty;

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
