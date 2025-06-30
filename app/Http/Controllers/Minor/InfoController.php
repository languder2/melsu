<?php

namespace App\Http\Controllers\Minor;

use App\Enums\Info\DocumentsFields;
use App\Http\Controllers\Controller;
use App\Models\Info\InfoBase;
use App\Models\Info\InfoCommon;
use App\Models\Info\InfoDocuments;
use App\Models\Info\InfoEducation;
use App\Models\Info\InfoFounder;
use App\Models\Info\InfoManagers;
use App\Models\Info\InfoStructure;
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

    public function standards(InfoBase $info, InfoDocuments $standards):View
    {
        return view('info.standards', compact('info' , 'standards'));
    }
    public function managers(InfoBase $info, InfoManagers $managers):View
    {
        return view('info.managers', compact('info', 'managers'));
    }

    public function employees(InfoBase $info):View
    {
        return view('info.wip', compact('info'));
    }

    public function objects(InfoBase $info):View
    {
        return view('info.wip', compact('info'));
    }

    public function grants(InfoBase $info):View
    {
        return view('info.wip', compact('info'));
    }

    public function paid_edu(InfoBase $info):View
    {
        return view('info.wip', compact('info'));
    }
    public function budget(InfoBase $info):View
    {
        return view('info.wip', compact('info'));
    }

    public function vacant(InfoBase $info):View
    {
        return view('info.wip', compact('info'));
    }

    public function inter(InfoBase $info):View
    {
        return view('info.wip', compact('info'));
    }

    public function catering(InfoBase $info):View
    {
        return view('info.catering', compact('info'));
    }


}
