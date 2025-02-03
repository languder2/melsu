<?php

namespace App\View\Components\admin\Education\Speciality\Form\Sections\Profiles;

use App\Models\Education\Forms;
use App\Models\Education\Speciality;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Profiles extends Component
{
    /**
     * Create a new component instance.
     */

    public array $forms;
    public ?Speciality $current;
    public function __construct(?Speciality $current = null)
    {
        $this->forms    = Forms::orderBy('order')->get()->pluck('name','code')->toArray();
        $this->current  = $current;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.admin.education.specialities.form.sections.profiles.profiles');
    }
}
