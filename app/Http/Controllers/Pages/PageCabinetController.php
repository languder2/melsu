<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageCabinetController extends Controller
{
    public function list(bool $onApproval = false): View
    {
        $list = Page::all();

        return view('pages.cabinet.list', compact('onApproval', 'list'));
    }

    public function form(Page $page): View
    {
        return view('pages.cabinet.form', compact('page'));
    }

    public function save(Request $request, Page $page): RedirectResponse
    {
        $form = $request->validate($page->validateRules(), $page->validateMessages());

        $page->fill($form)->save();

        $page->getContentRecord()->fill(['content' => $request->get('content')])->save();

        if($request->get('meta'))
            $page->metaSave($request->get('meta'), $request->file('meta.image'));

        return redirect()->to( $request->has('save-close') ? $page->cabinet_list_link : $page->cabinet_form_link );
    }

}
