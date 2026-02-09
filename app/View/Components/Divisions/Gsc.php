<?php

namespace App\View\Components\Divisions;

use App\Enums\DivisionType;
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


        $this->list->put(
            'goals', $division->publicGoals->map(fn($item) => $item->content()->render())->toArray()
        );

        if(in_array($division->type,[DivisionType::Institute, DivisionType::Faculty,  DivisionType::Department]))
            $this->list->put(
                'specialities', $division->publicSpecialities->groupBy('level')
                ->map(fn($level) => $level->map(
                    fn($item) =>
                        "$item->spec_code $item->name" . ( $item->name_profile ? "($item->name_profile)" : null)
                    )->toArray()
                )->toArray()
            );

        if(in_array($division->type,[DivisionType::Institute, DivisionType::Faculty,  DivisionType::Department, ]))
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
