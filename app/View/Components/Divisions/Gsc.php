<?php

namespace App\View\Components\Divisions;

use App\Models\Division\Division;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Gsc extends Component
{
    public Collection $list;
    public Division $division;

    public function __construct(Division $division)
    {
        $this->division = $division;

        $this->list = collect();

        if($division->publicGoals->isNotEmpty())
            $this->list->put(
                'goals', $division->publicGoals->map(fn($item) => $item->content()->render())->toArray()
            );

        if($division->publicSpecialities->isNotEmpty())
            $this->list->put(
                'specialities', $division->publicSpecialities->groupBy('level')
                    ->map(fn($level) => $level->map( fn($item) => "$item->spec_code $item->name")->toArray())
                    ->toArray()
            );

        if($division->publicCareers->isNotEmpty())
            $this->list->put(
                'careers', $division->publicCareers->pluck('name')->toArray()
            );
    }

    public function render(): View|Closure|string
    {
        return view('components.divisions.gsc', [
            'list'      => $this->list,
            'division'  => $this->division,
        ]);
    }
}
