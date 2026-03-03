<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use Illuminate\View\View;

class CabinetController extends Controller
{
    public function list(Division $division, bool $onApproval = false): View
    {
        return view('staffs.cabinet.list', compact('division'));
    }

}
