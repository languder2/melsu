<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CabinetStaffsController extends Controller
{
    public function list(){


        return view('staffs.cabinet.list');
    }
}
