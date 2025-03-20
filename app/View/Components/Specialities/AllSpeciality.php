<?php

namespace App\View\Components\Specialities;

use App\Enums\DivisionType;
use App\Models\Education\Department as EducationDepartment;
use App\Models\Education\Faculty;
use App\Models\Education\Speciality;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Division\Division;
class AllSpeciality extends Component
{
    public bool $short = false;
    public bool $showHeader = false;

    public array $options = [];

    public ?Division $division = null;

    /**
     * Create a new component instance.
     */
    public function __construct(?Division $division = null, $short = false, bool $showHeader = false)
    {
        if ($short)
            $this->short = true;

        if ($showHeader)
            $this->showHeader = true;

        $this->division = $division;

    }

    /**
     * Get the view / contents that represent the component.
     */

    public function short(): AllSpeciality
    {
        $this->short = true;
        return $this;
    }

    public function showHeader(): AllSpeciality
    {
        $this->showHeader = true;
        return $this;
    }

    public function render(): View|Closure|string
    {
        $specialities = Speciality::where('show',true);

        if ($this->division->type === DivisionType::Faculty)
            $specialities->where('faculty_id', $this->division->id);

        if ($this->division->type === DivisionType::Department)
            $specialities->where('department_id', $this->division->id);

        if ($this->short)
            $specialities->limit(9);

        return view('components.specialities.all-speciality', [
            'specialities' => $specialities->get(),
            'short' => $this->short,
            'show'  => $this->showHeader,
            'division' => $this->division,
        ]);
    }
}
