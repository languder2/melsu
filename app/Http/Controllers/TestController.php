<?php

namespace App\Http\Controllers;

use App\Models\Department\Department;

class TestController extends Controller
{
    public function index()
    {

        $all = Department::all();

        foreach ($all as $department) {

            $department->show = 0;
            $department->save();

        }

        dump($all->count());

        dd();

        return view('pages.page',[
            'contents'  => [
                view('test',['test'=>'test string'])
            ]
        ]);
    }
}
