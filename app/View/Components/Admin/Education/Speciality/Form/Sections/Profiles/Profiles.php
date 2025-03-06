<?php

namespace App\View\Components\admin\Education\Speciality\Form\Sections\Profiles;

use App\Models\Education\Forms;
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
    public ?Collection $profiles = null;

    public function __construct($profiles = null)
    {

        $this->forms = Forms::orderBy('order')->get()->pluck('name', 'code')->toArray();

        if ($profiles)
            $this->profiles = $profiles->keyBy('form_code');

        foreach ($this->profiles ?? [] as $profile)
            $profile->places = $profile->places->pluck('count', 'type')->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.education.specialities.form.sections.profiles.profiles');
    }
}
