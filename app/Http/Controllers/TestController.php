<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education\Faculty;
use App\Models\User;
use App\Enums\CardBG;

class TestController extends Controller
{
    public function index()
    {
        return view('test.page');

    }

}
