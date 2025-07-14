<?php

namespace App\Http\Controllers\Info;

use App\Enums\Info\Objects;
use App\Http\Controllers\Controller;
use App\Models\Info\InfoBase;
use App\Models\Info\InfoCatering;
use App\Models\Info\InfoObjects;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ObjectsController extends Controller
{
    public function index(InfoBase $info, InfoObjects $objects):View
    {
        return view('info.objects', compact('info','objects'));
    }

    public function form($code, ?InfoObjects $info):View
    {

        $case = $info->getCode($code);
        $cases = Objects::list();

        return view($case->getModalForm(), compact('code','info','case','cases'));
    }

    public function save(Request $request, string $code, ?InfoObjects $info):RedirectResponse
    {
        if(!auth()->check()) return redirect()->route('info:common');

        if(!$info->exists)
            $info->fill([
                'type'  => $info::Type,
                'code'  => $code,
            ])->save();

        $info->fill(['sort'  => $request->get('sort')])->save();

        $subs = collect($request->get('subs'));

        foreach ($info::Fields[$code] as $field)
            $info->getRelationInfo($field)
                ->fill([
                    'content' => $subs->get($field->name)
                ])->save();

        return redirect()->back();
    }

    public function delete(?InfoObjects $info):RedirectResponse
    {
        if(!auth()->check()) return redirect()->route('info:common');

        $info->delete();

        return redirect()->back();
    }

}
