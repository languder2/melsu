<?php

namespace App\View\Components\Department;

use App\Models\Division\Division;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class All extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $departments = Division::orderBy('order')->orderBy('name')->get();

        if (!$departments)
            return redirect()->route('pages:main');

        return view('components.department.all', [
            'departments' => $departments,
        ]);
    }
}
