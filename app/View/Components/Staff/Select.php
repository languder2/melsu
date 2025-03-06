<?php

namespace App\View\Components\Staff;

use App\Models\Staff\Staff;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */

    public $current;
    public ?array $staffs;
    public ?object $params;
    public ?object $staff = null;

    public function __construct($current = null, ?array $params = null,$staff = null)
    {

        $this->staffs = Staff::orderBy('lastname')
            ->orderBy('firstname')
            ->orderBy('middle_name')
            ->get()
            ->pluck('full_name', 'id')
            ->toArray();

        $this->current = $current;

        if (!is_null($params))
            $this->params = (object)$params;

        if($staff)
            $this->staff = is_array($staff) ? (object)$staff : $staff;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.staff.select');
    }
}
