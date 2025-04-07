<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Cabinet extends Controller
{
    public function index()
    {
        return view('cabinet.index');
    }
}
