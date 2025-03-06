<?php

namespace App\View\Components\Department;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use App\Models\Department\Department;
use PhpParser\Node\Expr\Array_;

class Select extends Component
{
    /**
     * Create a new component instance.
     */

    public ?array $list = null;

    public function __construct(?string $type = null, bool $branch = false)
    {
        $list = Department::query();


        switch ($type) {
            case "branch":
                $list->whereNull('parent_id')
                    ->where(function ($query){
                        $query->whereLike('name', '%филиал%')->orWhereLike('name', '%колледж%');
                    });
            break;

            case "faculty":
                $list->whereNull('parent_id')
                    ->where(function ($query){
                        $query->whereLike('name', '%филиал%')->orWhereLike('name', '%колледж%');
                    });
            break;
        }

        $this->list = $list->get()->pluck('name','id')->toArray();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.department.select');
    }
}
