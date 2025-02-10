<?php

namespace App\View\Components\Specialities;

use App\Models\Education\Department as EducationDepartment;
use App\Models\Education\Faculty;
use App\Models\Education\Speciality;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AllSpeciality extends Component
{

    public bool $short = false;

    public bool $showHeader = false;

    public array $options = [];

    public Faculty|null $faculty = null;
    public EducationDepartment|null $department = null;

    /**
     * Create a new component instance.
     */
    public function __construct($faculty = null, $department = null, $short = false, bool $showHeader = false)
    {

        if ($short)
            $this->short = true;

        if ($showHeader)
            $this->showHeader = true;

        $this->faculty = Faculty::where('code', $faculty)->first();
        $this->department = EducationDepartment::where('code', $department)->first();
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
        $specialities = new Speciality();

        if ($this->faculty)
            $specialities = $specialities->where('faculty_code', $this->faculty->code);

        if ($this->department)
            $specialities = $specialities->where('department_code', $this->department->code);

        if ($this->short)
            $specialities = $specialities->limit(9);

        return view('components.specialities.all-speciality', [
            'specialities' => $specialities->get(),
            'short' => $this->short,
            'show'  => $this->showHeader,
            'faculty' => $this->faculty,
            'department' => $this->department,
        ]);
    }
}
