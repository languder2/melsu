<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageCabinetController extends Controller
{
    public function list(bool $onApproval = false): View
    {
        $list = Page::all();

        return view('pages.cabinet.list', compact('onApproval', 'list'));
    }

    public function form(Request $request, Page $page)
    {
        dd($page);
    }


}
