<?php

namespace App\Http\Controllers\Minor;

use App\Enums\Info\Documents;
use App\Enums\Info\Founder;
use App\Http\Controllers\Controller;
use App\Models\Info\Info;
use App\Models\Info\InfoBase;
use App\Models\Info\InfoBudget;
use App\Models\Info\InfoCatering;
use App\Models\Info\InfoCommon;
use App\Models\Info\InfoDocuments;
use App\Models\Info\InfoEducation;
use App\Models\Info\InfoEmployees;
use App\Models\Info\InfoFounder;
use App\Models\Info\InfoGrants;
use App\Models\Info\InfoInter;
use App\Models\Info\InfoManagers;
use App\Models\Info\InfoObjects;
use App\Models\Info\InfoPaid;
use App\Models\Info\InfoStandarts;
use App\Models\Info\InfoStructure;
use App\Models\Info\InfoVacant;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InfoController extends Controller
{
    public function common(InfoBase $info, InfoCommon $common, InfoFounder $founder):View
    {

        return view('info.common', compact('common', 'info', 'founder'));
    }

    public function struct(InfoBase $info, InfoStructure $structure):View
    {

        return view('info.structure', compact('info','structure'));
    }

    public function document(InfoBase $info, InfoDocuments $documents):View
    {
        return view('info.documents', compact('info', 'documents'));
    }

    public function education(InfoBase $info, InfoEducation $education):View
    {

        return view('info.education', compact('info', 'education'));
    }

    public function standards(InfoBase $info, InfoStandarts $standards):View
    {
        return view('info.standards', compact('info' , 'standards'));
    }
    public function managers(InfoBase $info, InfoManagers $managers):View
    {
        return view('info.managers', compact('info', 'managers'));
    }

    public function employees(InfoBase $info, InfoEmployees $employees):View
    {
        return view('info.employees', compact('info','employees'));
    }

    public function objects(InfoBase $info, InfoObjects $objects):View
    {
        return view('info.objects', compact('info','objects'));
    }
    public function grants(InfoBase $info, InfoObjects $objects, InfoGrants $grants):View
    {
        return view('info.grants', compact('info','objects','grants'));
    }

    public function paid(InfoBase $info, InfoPaid $paid):View
    {
        return view('info.paid', compact('info','paid'));
    }
    public function budget(InfoBase $info, InfoBudget $budget):View
    {
        return view('info.budget', compact('info','budget'));
    }

    public function vacant(InfoBase $info, InfoVacant $vacant):View
    {

        return view('info.vacant', compact('info','vacant'));
    }

    public function inter(InfoBase $info, InfoInter $inter):View
    {
        return view('info.inter', compact('info','inter'));
    }

    public function catering(InfoBase $info, InfoCatering $catering):View
    {
        return view('info.catering', compact('info', 'catering'));
    }

    /* Auth */
    public function login(InfoBase $info):View|RedirectResponse
    {
        if(auth()->check())
            return redirect()->route('info:common');

        return view('info.login', compact('info'));
    }
    public function exit(InfoBase $info):RedirectResponse
    {
        auth()->logout();

        return redirect()->back();
    }

    /* data */

    public function form($type,$code,$item = null):View
    {
        $item = Info::find($item) ?? new Info(['type' => $type,'code' => $code]);

        return view('components.info.forms.info.text', compact('type','code','item'));
    }
    public function formPlace($type,$code,$item = null):View
    {
        $item = Info::find($item) ?? new Info(['type' => $type,'code' => $code]);

        return view('components.info.forms.info.text', compact('type','code','item'));
    }

    public function save($type,$code,$item = null):RedirectResponse
    {
        if(!auth()->check()) return redirect()->route('info:common');

        $item = Info::find($item) ?? new Info(['type' => $type,'code' => $code]);

        $item->fill(['content' => request('content')])->save();

        return redirect()->back();
    }

    public function delete(?Info $item):RedirectResponse
    {
        if(!auth()->check()) return redirect()->route('info:common');

        $item->delete();

        return redirect()->back();
    }


    /* Founder */

    public function formFounder(?InfoFounder $founder):View
    {
        return view('components.info.forms.common.founder', compact('founder'));
    }

    public function saveFounder(Request $request, ?InfoFounder $founder):RedirectResponse
    {
        if(!auth()->check()) return redirect()->route('info:common');

        if(!$founder->exists)
            $founder->fill([
                'type'  => $founder::Type,
                'code'  => $founder::Base,
            ])->save();

        foreach ($founder::Fields as $field)
            $founder->getRelationInfo($field)
                ->fill([
                    'content' => $request->get($field->name)
                ])->save();

        return redirect()->back();
    }

    /* Documents */

    public function formDocument($type, $code, ?Info $info):View
    {
        return view('components.info.forms.info.document', compact('type','code','info'));
    }

    public function saveDocument(Request $request, ?InfoFounder $founder):RedirectResponse
    {
        if(!auth()->check()) return redirect()->route('info:common');

        if(!$founder->exists)
            $founder->fill([
                'type'  => $founder::Type,
                'code'  => $founder::Base,
            ])->save();

        foreach ($founder::Fields as $field)
            $founder->getRelationInfo($field)
                ->fill([
                    'content' => $request->get($field->name)
                ])->save();

        return redirect()->back();
    }

}
