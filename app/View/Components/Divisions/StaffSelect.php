<?php

namespace App\View\Components\Divisions;

use App\Models\Staff\Affiliation;
use App\Models\Staff\Staff;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class StaffSelect extends Component
{
    public Collection $list;

    public function __construct()
    {
        $this->list = Staff::orderBy('lastname','asc')
            ->orderBy('firstname','asc')
            ->orderBy('middle_name','asc')
            ->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.divisions.staff-select',['list' => $this->list]);
    }
}
