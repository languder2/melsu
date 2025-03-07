<?php

namespace App\View\Components\Admin\Structure\Department;

use App\Models\Division\Division;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */

    public Division|Collection $list;

    public function __construct($where = null,$order = ['name','asc'])
    {

        $this->list = Division::orderBy($order);

        dd(1);

        $this->list->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.structure.department.select');
    }
}
