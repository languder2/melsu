<?php

namespace App\Http\Controllers;

use App\Models\Department\Department;

class TestController extends Controller
{
    public function index()
    {
        return view('pages.page',[
            'contents'  => [
                view('test',['test'=>'test string'])
            ]
        ]);
    }
}
