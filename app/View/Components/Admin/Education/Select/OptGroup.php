<?php

namespace App\View\Components\Admin\Education\Select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use App\Models\Education\Faculty;
use App\Models\Education\Department;
use App\Models\Education\Lab;

class OptGroup extends Component
{
    /**
     * Create a new component instance.
     */

    public Collection $faculties;
    public Collection $departments;
    public Collection $labs;
    public ?string $current;

    public function __construct(?string $current = null)
    {
        $this->faculties    = Faculty::where('type','faculty')->orderBy('name')->get()->pluck('name', 'id');
        $this->departments  = Department::orderBy('name')->get()->pluck('name', 'id');
        $this->labs         = Lab::orderBy('name')->get()->pluck('name', 'id');
        $this->current      = old('_token') ? old('identity') : $current ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.education.select.opt-group');
    }
}
