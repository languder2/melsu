<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\News\RelationNews;
use App\Models\Users\UserAccess;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;


class CabinetNewsController extends Controller
{
    public function list(Request $request): View
    {

        $list = RelationNews::get();

        $filters = $request->session()->get('cabinetNewsFilters', collect());

        if($filters->has('division'))
            $list= $list->where(fn($item)  => $item->relation_id == $filters->get('division') && $item->relation_type == Division::class);

        return view('news.cabinet.list', compact('list'));
    }

    public function setFilter(Request $request): RedirectResponse
    {
        $filters = $request->collect('setFilter')->where(fn($item) => !empty($item));

        $request->session()->put('cabinetNewsFilters', $filters);

        return redirect()->route('news.cabinet.list');
    }



}
