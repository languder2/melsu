<?php

namespace App\View\Components\Divisions;

use App\Enums\EducationBasis;
use App\Models\Division\Division;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Specialities extends Component
{

    public Division $division;

    public Collection $specialities;
    public Collection $profiles;
    public Collection $forms;
    public Collection $levels;
    public Collection $bases;


    public function __construct(Division $division)
    {
        $this->division         = $division;

        $this->levels           = $division->specialities->pluck('level')->unique()
                                ->mapWithKeys(fn($item) => [$item->value => $item->label()]);

        $this->specialities     = $division->specialities;

        $this->profiles         = $division->specialities->flatMap(fn($item) => $item->profiles);

        $this->forms            = $this->profiles->pluck('form')->unique()
            ->mapWithKeys(fn($item) => [$item->value => $item->label()]);

        $this->bases = EducationBasis::getList();

    }

    public function render(): View|Closure|string
    {
        return view('components.divisions.specialities');
    }
}
