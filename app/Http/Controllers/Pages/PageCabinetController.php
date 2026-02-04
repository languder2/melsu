<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageCabinetController extends Controller
{
    public function list(bool $onApproval = false): View
    {
        $list = auth()->user()->isEditor() ? Page::all() : auth()->user()->pages;

        return view('pages.cabinet.list', compact('onApproval', 'list'));
    }

    public function form(Page $page): View
    {
        Gate::authorize('access-page', $page);

        return view('pages.cabinet.form', compact('page'));
    }

    public function save(Request $request, Page $page): RedirectResponse
    {
        Gate::authorize('access-page', $page);

        $form = $request->validate($page->validateRules(), $page->validateMessages());

        $page->fill($form)->save();

        $page->getContentRecord()->fill(['content' => $request->get('content')])->save();

        if($request->file('image'))
            $page->image->saveImage($request->file('image'));

        if($request->get('meta'))
            $page->metaSave($request->get('meta'), $request->file('meta.image'));

        return redirect()->to( $request->has('save-close') ? $page->cabinet_list_link : $page->cabinet_form_link );
    }

    public function delete(Page $page): RedirectResponse
    {
        Gate::authorize('access-page', $page);

        $page->delete();

        return redirect()->back();
    }
}
