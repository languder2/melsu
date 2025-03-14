<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education\Faculty;
use App\Models\User;

class TestController extends Controller
{
    public function index()
    {


//        User::create([
//           'name' => 'porki',
//           'email' => 'petrovskijv4@gmail.com',
//            'password' => bcrypt('torotorkin_V222527')
//        ]);

        dd();
        return view('test.page');

    }

    public function save(Request $request)
    {
        $request->validate(['test2'=>'required']);
    }
}
