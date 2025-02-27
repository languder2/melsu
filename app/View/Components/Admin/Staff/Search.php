<?php

namespace App\View\Components\Admin\Staff;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Search extends Component
{
    /**
     * Create a new component instance.
     */

    public ?object $filter = null;
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if(session()->has('AdminStaffsFilter'))
            $this->filter = json_decode(session()->get('AdminStaffsFilter'));

        return view('components.admin.staff.search',['filter'=>$this->filter]);
    }
}
