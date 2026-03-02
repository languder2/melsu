<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use Illuminate\View\View;

class CabinetController extends Controller
{
    public function list(Division $division): View
    {


        dd($division->staffs->first()->post);

        $list = $division->staffs;

        dd($list->first()->staff);

        return view('staffs.cabinet.list', []);
    }

}
