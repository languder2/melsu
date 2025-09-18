<?php

namespace App\Http\Controllers\Division;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CabinetDivisionsController extends Controller
{
    public function list(): View
    {
        $list = auth()->user()->access
            ->where(fn($item) => $item->relation)
            ->mapWithKeys(fn($item) => [$item->id => $item->relation])
            ->sortBy('name')
        ;

        return view('divisions.cabinet.list', compact('list'));
    }

}
