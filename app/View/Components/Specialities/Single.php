<?php

namespace App\View\Components\Specialities;

use App\Models\Education\Speciality;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Single extends Component
{

    public ?Speciality $speciality;

    /**
     * Create a new component instance.
     */
    public function __construct($speciality)
    {
        $this->speciality = $speciality;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.specialities.single', [
            'speciality' => $this->speciality
        ]);
    }
}
