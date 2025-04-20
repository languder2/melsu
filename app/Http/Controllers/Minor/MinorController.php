<?php

namespace App\Http\Controllers\Minor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MinorController extends Controller
{
    public function index():View
    {
        return view('minors.admin.index');
    }
}
