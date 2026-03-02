<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use Illuminate\View\View;

class CabinetController extends Controller
{
    public function list(Division $division): View
    {

        dd($division->leader);


        $list = collect([$division->leader])->merge($division->staffs);

        dd($list);

        return view('staffs.cabinet.list', []);
    }

}
