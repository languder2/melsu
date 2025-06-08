<?php

namespace App\View\Components\Specialities\Admin;

use App\Enums\DivisionType;
use App\Enums\EducationLevel;
use App\Models\Division\Division;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Filters extends Component
{

    public Collection $institutes;
    public Collection $faculties;
    public Collection $departments;
    public Collection $branches;

    public Collection $levels;
    public Collection $is_show_list;

    public Collection $filters;

    public string $route;


    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->levels       = EducationLevel::getList();

        $this->is_show_list = collect(['true' => 'активно', 'false' => 'не активно']);

        $this->filters      = collect(session()->get('specialities:admin:filters') ?? []);

        $this->institutes   = Division::where('type',DivisionType::Institute)->orderBy('name')->get()->pluck('name', 'id');
        $this->faculties    = Division::where('type',DivisionType::Faculty)->orderBy('name')->get()->keyBy('id')
            ->map(function ($item){
                return "{$item->acronym} | {$item->name}";
            });

        $this->departments  = Division::where('type',DivisionType::Department)->get()->keyBy('id')
            ->sortBy(function ($item) {
                return $item->parent ? ($item->parent->acronym ?? null) : null;
            })
            ->map(function ($item){
                return $item->parent ? "{$item->parent->acronym} | {$item->name}" : $item->name;
            });

        $this->branches     = Division::where('type',DivisionType::Branch)->orderBy('name')->get()->pluck('name', 'id');

        $this->route        = route('specialities:admin:set-filter');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('specialities.admin.components.filters');
    }

    public static function rules(): array
    {
        return [
            'search'        => '',
            'institute'     => '',
            'faculty'       => '',
            'department'    => '',
            'branch'        => '',
            'level'         => '',
            'is_show'       => '',
        ];

    }

}
