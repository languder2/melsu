<?php

namespace App\View\Components\Specialities;

use App\Models\Education\Speciality;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class AllSpeciality extends Component
{

    public Collection $specialities;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->specialities = Speciality::get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.specialities.all-speciality',[
            'specialities' => $this->specialities
        ]);
    }
}
