<?php

namespace App\View\Components\Divisions;

use App\Models\Division\Division;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Structure extends Component
{

    public ?Division $division;
    public Collection $list;

    public function __construct(int $division = null, array $before = [], array $after = [])
    {
        $this->division = Division::find($division) ?? new Division();

        $before = collect($before)->map(fn($item) => (object)$item)->each(fn($item) => $item->level = 0);
        $after = collect($after)->map(fn($item) => (object)$item)->each(fn($item) => $item->level = 0);


        $this->list = $before->merge($this->division->getFlattenTree())->merge($after)
        ;
    }

    public function render(): View|Closure|string
    {
        return view('components.divisions.structure', [
            'division'      => $this->division,
            'list'          => $this->list,
        ]);
    }
}
