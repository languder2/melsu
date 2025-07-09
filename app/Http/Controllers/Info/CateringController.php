<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use App\Models\Documents\Document;
use App\Models\Info\Info;
use App\Models\Info\InfoBase;
use App\Models\Info\InfoCatering;
use App\Models\Info\InfoDocuments;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CateringController extends Controller
{
    public function index(InfoBase $info, InfoCatering $catering):View
    {
        return view('info.catering', compact('info', 'catering'));
    }

    public function form($code, ?InfoCatering $info):View
    {

        return view('components.info.catering.form', compact('code','info'));
    }

    public function save(Request $request, ?InfoCatering $info):RedirectResponse
    {
        if(!auth()->check()) return redirect()->route('info:common');

        if(!$info->exists)
            $info->fill([
                'type'  => $info::Type,
                'code'  => $request->get('code'),
            ])->save();

        $info->fill(['sort'  => $request->get('sort')])->save();

        foreach ($info::Fields as $field)
            $info->getRelationInfo($field)
                ->fill([
                    'content' => $request->get($field->name)
                ])->save();

        return redirect()->back();
    }

    public function delete(?InfoCatering $item):RedirectResponse
    {
        if(!auth()->check()) return redirect()->route('info:common');

        $item->delete();

        return redirect()->back();
    }

}
