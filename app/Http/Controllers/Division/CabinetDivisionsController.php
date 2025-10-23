<?php

namespace App\Http\Controllers\Division;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class CabinetDivisionsController extends Controller
{

    protected Collection $divisions;
    public function __construct(){
        $this->divisions = auth()->user()->isEditor()
            ? Division::orderBy('name')->get()->keyBy('id')
            : auth()->user()->access->map(fn($item) => $item->relation)->keyBy('id');
    }

    public function list(): View
    {
        $list = Division::flattenNestedCollection($this->divisions);

        return view('divisions.cabinet.list', compact('list'));
    }

    public function form(?Division $division): View
    {
        $divisions = Division::flattenNestedCollection($this->divisions)->keyBy('id')
            ->map(
                fn ($item) =>
                    str_repeat('&nbsp;', $item->level*3)
                    . ($item->level ? __('common.arrowT2R')  : '' )
                    . $item->name
            );

        $types = DivisionType::labels();

        return view('divisions.cabinet.form', compact('division', 'divisions', 'types'));
    }


}
