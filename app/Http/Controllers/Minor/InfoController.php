<?php

namespace App\Http\Controllers\Minor;

use App\Enums\Info\DocumentsFields;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class InfoController extends Controller
{

    public function common():View
    {
        dd(DocumentsFields::priemDocLink->getName());
        return view('info.common');
    }

}
