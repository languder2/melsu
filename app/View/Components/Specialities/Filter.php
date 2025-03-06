<?php

namespace App\View\Components\Specialities;

use App\Models\Education\Forms;
use App\Models\Education\Level;
use App\Models\Education\Place;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class Filter extends Component
{

    public array $levels;
    public array $forms;
    public array $types;
    public object $current;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->levels = Level::all()->pluck('name', 'code')->toArray();
        $this->forms = Forms::all()->pluck('name', 'code')->toArray();
        $this->types = [
            'budget' => 'Бюджет',
            'contract' => 'Контракт',
        ];
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
