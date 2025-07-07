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
        dd($info->save);
        return view('components.info.catering.form', compact('code','info'));
    }

    public function save(Request $request, $type, $code, ?InfoDocuments $info):RedirectResponse
    {
        if(!auth()->check()) return redirect()->route('info:common');

        if(!$info->exists)
            $info->fill(['type' => $type,'code' => $code])->save();

        $info->fill(['content' => $request->get('content'), 'sort' => $request->get('sort')])->save();

        if(request()->hasFile('file')){

            $form = ['title' => $request->get('content'), 'file' => $request->file('file')];

            Document::FileSave($form, $info);

            $info->getDocument()->fill($form)->save();
        }

        return redirect()->back();
    }

    public function delete(?InfoCatering $item):RedirectResponse
    {
        if(!auth()->check()) return redirect()->route('info:common');

        $item->delete();

        return redirect()->back();
    }

}
