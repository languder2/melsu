<?php

namespace App\Http\Controllers\Division;

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

}
