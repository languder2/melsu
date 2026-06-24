<?php

namespace App\View\Components\Specialities;

use App\Enums\DivisionType;
use App\Enums\EducationLevel;
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

    public function short(): self
    {
        $this->short = true;
        return $this;
    }

    public function showHeader(): self
    {
        $this->showHeader = true;
        return $this;
    }

    public function render(): View|Closure|string
    {

        $query = $this->division->exists ? $this->division->specialities() : Speciality::query();

        if ($this->short)
            $query->limit(9);

        $specialities = $query
            ->isShow()
            ->orderByLevel()
            ->orderBy('spec_code')
            ->orderBy('name')
            ->whereHas('profiles', fn($query) => $query->isShow())
            ->get()
        ;

        return view('components.specialities.all-speciality', [
            'specialities'  => $specialities,
            'is_short'      => $this->short,
            'show'          => $this->showHeader,
            'division'      => $this->division,
        ]);
    }
}
