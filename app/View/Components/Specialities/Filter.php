<?php

namespace App\View\Components\Specialities;

use App\Enums\EducationBasis;
use App\Enums\EducationForm;
use App\Enums\EducationLevel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;


class Filter extends Component
{

    public Collection $levels;
    public Collection $forms;
    public Collection $types;
    public object $current;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->levels   = EducationLevel::getList();
        $this->forms    = EducationForm::getList();
        $this->types    = EducationBasis::getList();

        $this->current = (object)[];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.specialities.filter');
    }
}
